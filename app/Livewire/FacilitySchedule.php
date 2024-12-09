<?php

namespace App\Livewire;

use App\Models\FacilitySchedule as FacilityScheduleModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class FacilitySchedule extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $dateFilter;
    public $facilityFilter;
    public $statusFilter;

    public $tempDateFilter;
    public $tempFacilityFilter;
    public $tempStatusFilter;

    #[On('refresh-list')]
    public function refresh() {}

    public function applyFilters()
    {
        $this->dateFilter = $this->tempDateFilter;
        $this->facilityFilter = $this->tempFacilityFilter;
        $this->statusFilter = $this->tempStatusFilter;

        $this->resetPage();
    }

    public function delete($id)
    {
        $facilitySchedule = FacilityScheduleModel::findOrFail($id);
        $facilitySchedule->delete();

        $this->dispatch('refresh-list');
    }

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = FacilityScheduleModel::query();

        // Apply filters based on the user's role
        if (auth()->user()->hasRole('superadmin|administrator|support')) {
            if ($this->dateFilter) {
                $query->whereDate('start', $this->dateFilter);
            }
            if ($this->facilityFilter) {
                $query->where('facility_id', $this->facilityFilter);
            }
            if ($this->statusFilter) {
                $query->where('status', $this->statusFilter);
            }
        } else {
            $query->where('user_id', auth()->user()->id);
            if ($this->dateFilter) {
                $query->whereDate('start', $this->dateFilter);
            }
            if ($this->facilityFilter) {
                $query->where('facility_id', $this->facilityFilter);
            }
            if ($this->statusFilter) {
                $query->where('status', $this->statusFilter);
            }
        }

        // Fetch filtered facility schedules
        $facilitySchedules = $query->orderBy('start', 'desc')->paginate(10);

        // Format start and end dates for display
        foreach ($facilitySchedules as $schedule) {
            $schedule->formatted_start = \Carbon\Carbon::parse($schedule->start)->format('M. j, g:iA');
            $schedule->formatted_end = \Carbon\Carbon::parse($schedule->end)->format('M. j, g:iA');
        }

        // Fetch facilities for dropdown or other use in the view
        $facilities = \App\Models\Facility::all(); // Adjust the model and query if needed

        return view('livewire.facility.schedule', [
            'facilitySchedules' => $facilitySchedules,
            'facilities' => $facilities,
        ]);
    }

}
