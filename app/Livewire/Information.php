<?php

namespace App\Livewire;

use App\Models\Information as InformationModel;
use App\Models\InformationCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Information extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $filterCategoryId = '';

    protected $updatesQueryString = ['search', 'filterCategoryId'];

    #[On('refresh-list')]
    public function refresh() {}

    public function searchInformation()
    {
        $this->resetPage(); // Reset pagination to the first page
    }

    public function updatedFilterCategoryId()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterCategoryId = '';
        $this->resetPage();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $query = InformationModel::query();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->filterCategoryId !== '') {
            $query->where('category_id', $this->filterCategoryId);
        }

        // Use the query for pagination
        $informations = $query->orderBy('is_pinned', 'desc')->orderBy('created_at', 'desc')->paginate(10);

        // Get all categories for filter dropdown
        $categories = InformationCategory::orderBy('name')->get();

        return view('livewire.information.list', [
            'informations' => $informations,
            'categories' => $categories,
        ]);
    }
}
