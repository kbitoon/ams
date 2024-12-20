<?php

namespace App\Livewire;

use App\Models\VehicleSchedule;
use Livewire\Component;

class VehicleCalendar extends Component
{
    public $vehicleSchedules;

    protected $listeners = ['refreshCalendar' => '$refresh'];

    public function mount()
    {
        $this->vehicleSchedules = VehicleSchedule::all()->map(function ($vehicleSchedule) {
            return [
                'title' => $vehicleSchedule->destination,
                'driver' => empty($vehicleSchedule->driver->name) ? '' : $vehicleSchedule->driver->name, 
                'contact_number' => empty($vehicleSchedule->driver->contact_number) ? '' : $vehicleSchedule->driver->contact_number, 
                'vehicle' => $vehicleSchedule->vehicle->name,
                'start' => \Carbon\Carbon::parse($vehicleSchedule->start)->toISOString(),
                'end' => \Carbon\Carbon::parse($vehicleSchedule->end)->toISOString(),
                
            ];
        });
    }

   public function render()
{
    return view('livewire.vehicle.calendar', [
        'vehicleSchedules' => $this->vehicleSchedules
    ]);
}

}
