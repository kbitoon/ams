<?php

namespace App\Livewire;

use App\Models\VehicleSchedule as VehicleScheduleModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class VehicleSchedule extends Component
{
    use WithPagination;

    protected $listeners = ['refreshList' => 'refresh'];

    public function refresh(){
        $this->resetPage(); 
    }

    public function markAsDone($scheduleId)
    {
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
    public function markAsOngoing($scheduleId)
    {
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

    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Get today's date
        $today = Carbon::today();

        // Query all schedules and prioritize those that are not 'Done'
        $vehicleSchedules = auth()->user()->hasRole('superadmin|administrator')
            ? VehicleScheduleModel::where(function($query) use ($today) {
                $query->where('status', '!=', 'Done')
                    ->where('start', '>=', $today); // Fetch not done schedules for today or future dates
            })
            ->orWhere(function($query) use ($today) {
                $query->where('status', 'Done')
                    ->orWhere('start', '<', $today); // Include done or past schedules
            })
            ->orderByRaw("FIELD(status, 'Ongoing', 'Pending', 'Done')") // Prioritize by status
            ->orderBy('start', 'asc') // Sort by start date, with upcoming first
            ->paginate(10)

            : VehicleScheduleModel::where('user_id', auth()->user()->id)
            ->where(function($query) use ($today) {
                $query->where('status', '!=', 'Done')
                    ->where('start', '>=', $today); 
            })
            ->orWhere(function($query) use ($today) {
                $query->where('status', 'Done')
                    ->orWhere('start', '<', $today); 
            })
            ->orderByRaw("FIELD(status, 'Ongoing', 'Pending', 'Done')")
            ->orderBy('start', 'asc')
            ->paginate(10);

        // Format the start and end dates
        foreach ($vehicleSchedules as $schedule) {
            $schedule->formatted_start = Carbon::parse($schedule->start)->format('M. j,  g:iA');
            $schedule->formatted_end = Carbon::parse($schedule->end)->format('M. j,  g:iA');
        }

        return view('livewire.vehicle.schedule', [
            'vehicleSchedules' => $vehicleSchedules,
        ]);
    }


}
