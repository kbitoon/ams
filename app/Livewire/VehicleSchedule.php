<?php

namespace App\Livewire;

use App\Models\VehicleSchedule as VehicleScheduleModel;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleSchedule extends Component
{
    use WithPagination;

    public $dateFilter;
    public $vehicleFilter;
    public $statusFilter;

    public $tempDateFilter;
    public $tempVehicleFilter;
    public $tempStatusFilter;

    protected $listeners = ['refreshList' => 'refresh'];

    public function refresh(){
        $this->resetPage(); 
    }


    public function applyFilters()
    {
        $this->dateFilter = $this->tempDateFilter;
        $this->vehicleFilter = $this->tempVehicleFilter;
        $this->statusFilter = $this->tempStatusFilter;


        $this->resetPage();
    }

    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {

        $vehicles = Vehicle::all();

        $query = VehicleScheduleModel::query();

        if (auth()->user()->hasRole('superadmin|administrator')) {
            if ($this->dateFilter) {
                $query->whereDate('start', $this->dateFilter);
            }
            if ($this->vehicleFilter) {
                $query->where('vehicle_id', $this->vehicleFilter);
            }
            if ($this->statusFilter) {
                $query->where('status', $this->statusFilter);
            }
        } else {
            $query->where('user_id', auth()->user()->id);
            if ($this->dateFilter) {
                $query->whereDate('start', $this->dateFilter);
            }
            if ($this->vehicleFilter) {
                $query->where('vehicle_id', $this->vehicleFilter);
            }
            if ($this->statusFilter) {
                $query->where('status', $this->statusFilter);
            }
        }

        $vehicleSchedules = $query->orderBy('start', 'desc')->paginate(10);

        foreach ($vehicleSchedules as $schedule) {
            $schedule->formatted_start = Carbon::parse($schedule->start)->format('M. j,  g:iA');
            $schedule->formatted_end = Carbon::parse($schedule->end)->format('M. j,  g:iA');
        }

        return view('livewire.vehicle.schedule', [
            'vehicleSchedules' => $vehicleSchedules,
            'vehicles' => $vehicles,
        ]);
    }
}
