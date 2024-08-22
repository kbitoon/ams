<?php

namespace App\Livewire;

use App\Models\Item as ItemModel;
use App\Models\ItemCategory;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Item extends Component
{
    use WithPagination;

    public string $search = '';
    public string $categoryFilter = '';

    protected $updatesQueryString = ['search', 'categoryFilter'];

    public function searchItems()
    {
        $this->resetPage(); // Reset pagination to the first page

        // Trigger the render method
        $this->render();
    }

    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $query = ItemModel::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->categoryFilter) {
            $query->where('category_id', $this->categoryFilter);
        }

        $items = $query->paginate(10);
        $categories = ItemCategory::all();

        return view('livewire.item.listing', [
            'items' => $items,
            'categories' => $categories,
        ]);
    }
}
