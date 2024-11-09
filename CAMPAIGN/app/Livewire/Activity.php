<?php

namespace App\Livewire;

use App\Models\Activity as ActivityModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Activity extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $dateFilter;
    public $districtFilter;
    public $search;

    public $tempDateFilter;
    public $tempDistrictFilter;
    public $tempSearch;



    #[On('refresh-list')]
    public function refresh() {}

    public function applyFilters()
    {
        $this->dateFilter = $this->tempDateFilter;
        $this->districFilter = $this->tempDistrictFilter;

        $this->resetPage();
    }

    public function delete($id)
    {
        
        $activity = ActivityModel::findOrFail($id);
        $activity->delete();

        $this->dispatch('refresh-list');
    }

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {

        $query = ActivityModel::query();
        if ($this->dateFilter) {
            $query->whereDate('date', $this->dateFilter);
        }
        if ($this->districtFilter) {
            $query->where('district', $this->districtFilter);
        }
        if ($this->search) {
            $query->where('description', 'like', '%' . $this->search . '%');
        }
        $activity = $query->orderBy('date', 'desc')->paginate(10);
        return view('livewire.campaign.activity', [
            'activities' => $activity,
        ]);
    }
}
