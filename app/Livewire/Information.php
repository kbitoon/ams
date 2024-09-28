<?php

namespace App\Livewire;

use App\Models\Information as InformationModel;
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

    protected $updatesQueryString = ['search',];

    #[On('refresh-list')]
    public function refresh() {}

    public function searchInformation()
    {
        $this->resetPage(); // Reset pagination to the first page
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

        // Use the query for pagination
        $informations = $query->paginate(10);

        return view('livewire.information.list', [
            'informations' => $informations,
        ]);
    }
}
