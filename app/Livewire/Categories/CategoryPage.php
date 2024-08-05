<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryPage extends Component
{
    use WithPagination;
    #[Title('List Categories')]

    #[Url]
    public $search = '';

    protected $listeners = ['categoryUpdated' => 'render', 'categoryDeleted' => 'render'];

    public $loading = false;


    public function startLoading()
    {
        $this->loading = true;
    }

    public function stopLoading()
    {
        $this->loading = false;
    }
    public function edit($categoryId)
    {
        $this->dispatch('editCategory', $categoryId);
    }

    public function delete($categoryId)
    {
        $this->dispatch('deleteCategory', $categoryId);
    }
    public function render()
    {
        $categories = Category::search($this->search)->paginate(10);
        return view('livewire.categories.category-page', compact('categories'));
    }
}
