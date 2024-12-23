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
    public function delete($id)
    {
        $vehicleSchedule = VehicleScheduleModel::findOrFail($id);
        $vehicleSchedule->delete();

        $this->dispatch('refresh-list');
    }

    public function markAsDone($scheduleId){

        $schedule = VehicleScheduleModel::find($scheduleId);
        if ($schedule) {
            $schedule->status = 'Done';
            $schedule->save();

            // Set vehicle and driver to unavailable
            if ($schedule->vehicle) {
                $schedule->vehicle->update(['status' => 'Available']);
            }
            if ($schedule->driver) {
                $schedule->driver->update(['status' => 'Available']);
            }
        }
    }

    public function markAsOngoing($scheduleId){
        $schedule = VehicleScheduleModel::find($scheduleId);

        if ($schedule) {
            $schedule->status = 'Ongoing';
            $schedule->save();
               // Set vehicle and driver to unavailable
            if ($schedule->vehicle) {
            $schedule->vehicle->update(['status' => 'Unavailable']);
            }
            if ($schedule->driver) {
                $schedule->driver->update(['status' => 'Unavailable']);
            }
        }
    }

    public function approve($scheduleId)
    {
        $schedule = VehicleScheduleModel::find($scheduleId);
        if ($schedule) {
            $schedule->is_approved = 1; // Set is_approved to 1
            $schedule->save();

            session()->flash('message', 'Schedule approved successfully.');
            $this->refresh(); // Refresh the list
        }
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
        
            // Role-based filtering
            if (auth()->user()->hasRole('superadmin|administrator|support')) {
                // Can view all schedules
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
                // Non-admin/support users can only view their own schedules
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

