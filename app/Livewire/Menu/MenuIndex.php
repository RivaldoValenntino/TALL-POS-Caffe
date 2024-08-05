<?php

namespace App\Livewire\Menu;

use App\Models\Menu;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MenuIndex extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';
    #[Title('List Menu')]

    protected $listeners = ['menuUpdated' => 'render'];
    public function edit($menuId)
    {
        $this->dispatch('editMenu', $menuId);
    }

    public function delete($menuId)
    {
        $this->dispatch('deleteMenu', $menuId);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $menus = Menu::with('category')
            ->search($this->search)
            ->paginate(6)
            ->withQueryString();
        return view('livewire.menu.menu-index', compact('menus'));
    }
}
