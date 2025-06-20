<?php

namespace App\Livewire;

use App\Models\VehicleSchedule;
use Livewire\Component;
use Carbon\Carbon;

class VehicleCalendar extends Component
{
    public $vehicleSchedules;

    protected $listeners = ['refreshCalendar' => '$refresh'];

    public function mount()
    {
        $this->vehicleSchedules = VehicleSchedule::where('is_approved', 1)->get()->map(function ($vehicleSchedule) {
            return [
                'name' => $vehicleSchedule->name,
                'details' => $vehicleSchedule->details ?? '',
                'title' => $vehicleSchedule->destination,
                'driver' => $vehicleSchedule->driver->name ?? '',
                'contact_number' => $vehicleSchedule->driver->contact_number ?? '',
                'vehicle' => $vehicleSchedule->vehicle->name ?? '',
                'calendar_color' => $vehicleSchedule->vehicle->calendar_color ?? '#AB886D',
                'start' => Carbon::parse($vehicleSchedule->start)->toISOString(),
                'end' => Carbon::parse($vehicleSchedule->end)->toISOString(),
            ];
        })->toArray();
    }
    public function render()
    {
        return view('livewire.vehicle.calendar', [
            'vehicleSchedules' => $this->vehicleSchedules
        ]);
    }
}

