<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CategoryActions extends Component
{
    use WithFileUploads;

    public $categoryId;
    public $name;
    public $image;
    public $oldImage;
    public $stock;
    public $show = false;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Nama Category wajib diisi',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->image = null;
        $this->oldImage = null;
        $this->stock = '';
        $this->isEditing = false;
    }

    public function create()
    {
        $this->resetForm();
        $this->show = true;
        $this->isEditing = false;
    }

    public function edit(Category $category)
    {
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->oldImage = $category->image;
        $this->isEditing = true;
        $this->show = true;
    }

    public function getModalTitleProperty()
    {
        return $this->isEditing ? 'Edit Category' : 'Create Category';
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->show = false;
        $this->isEditing = false;
    }

    public function store()
    {
        $validatedData = $this->validate();

        // Check if a new image is being uploaded
        if ($this->image) {
            // Store the new image and remove the old image if it exists
            $validatedData['image'] = $this->image->store('uploads', 'public');

            if ($this->oldImage) {
                Storage::disk('public')->delete($this->oldImage);
            }
        } else {
            // If no new image is uploaded, keep the old image
            $validatedData['image'] = $this->oldImage;
        }

        // Update or create category
        if ($this->categoryId) {
            $category = Category::find($this->categoryId);
            $category->update($validatedData);
        } else {
            Category::create($validatedData);
        }

        $this->dispatch('categoryUpdated');

        $this->show = false;
        $this->resetForm();

        toastr()->success('Category saved successfully');

        return redirect()->back();
    }

    protected $listeners = ['editCategory' => 'loadCategory', 'deleteCategory' => 'delete'];

    public function loadCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $this->edit($category);
    }

    public function delete($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();

        $this->dispatch('categoryUpdated');
        toastr()->success('Category deleted successfully');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.categories.category-actions');
    }
}
