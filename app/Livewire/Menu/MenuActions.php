<?php

namespace App\Livewire\Menu;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class MenuActions extends Component
{
    use WithFileUploads;

    public $menuId;
    public $oldImage;
    public $category_id;
    public $name;
    public $price;
    public $status = 1;
    public $description;
    public $image;
    public $loading = false;
    public $show = false;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'category_id' => 'required|exists:categories,id',
    ];

    protected $messages = [
        'name.required' => 'Nama menu wajib diisi',
        'description.required' => 'Deskripsi wajib diisi',
        'price.required' => 'Harga wajib diisi',
        'category_id.required' => 'Kategori wajib diisi',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->menuId = null;
        $this->name = '';
        $this->oldImage = null;
        $this->image = null;
        $this->category_id = '';
        $this->price = '';
        $this->description = '';
        $this->image = '';
        $this->isEditing = false;
    }


    public function closeModal()
    {
        $this->resetForm();
        $this->show = false;
        $this->isEditing = false;
    }
    public function create()
    {
        $this->resetForm();
        $this->show = true;
        $this->isEditing = false;
    }

    public function edit(Menu $menu)
    {
        $this->menuId = $menu->id;
        $this->name = $menu->name;
        $this->price = $menu->price;
        $this->category_id = $menu->category_id;
        $this->description = $menu->description;
        $this->oldImage = $menu->image;
        $this->isEditing = true;
        $this->show = true;
    }

    public function store()
    {
        $validatedData = $this->validate();
        // Konversi harga ke format numerik
        $validatedData['price'] = currencyIDRtoNumeric($this->price);
        if ($this->image) {
            $validatedData['image'] = $this->image->store('menus', 'public');

            if ($this->oldImage) {
                Storage::disk('public')->delete($this->oldImage);
            }
        } else {
            $validatedData['image'] = $this->oldImage;
        }

        if ($this->menuId) {
            $menu = Menu::find($this->menuId);
            $menu->update($validatedData);
        } else {
            Menu::create($validatedData);
        }

        $this->dispatch('menuUpdated');

        $this->show = false;
        $this->resetForm();

        toastr()->success('Menu saved successfully');

        return redirect()->back();
    }

    public function getModalTitleProperty()
    {
        return $this->isEditing ? 'Edit Menu' : 'Create Menu';
    }

    protected $listeners = ['editMenu' => 'loadMenu', 'deleteMenu' => 'delete'];

    public function loadMenu($menuId)
    {
        $menu = Menu::findOrFail($menuId);
        $this->edit($menu);
    }

    public function delete($menuId)
    {
        $menu = Menu::findOrFail($menuId);
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }
        $menu->delete();
        $this->dispatch('menuUpdated');
        toastr()->success('Menu deleted successfully');
        return redirect()->back();
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.menu.menu-actions', compact('categories'));
    }
}