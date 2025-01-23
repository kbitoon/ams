<?php

namespace App\Livewire;

use App\Models\FacilitySchedule;
use Livewire\Component;
use Carbon\Carbon;

class FacilityCalendar extends Component
{
    public $facilitySchedules;

    protected $listeners = ['refreshCalendar' => '$refresh'];

    public function mount()
    {
        $this->facilitySchedules = FacilitySchedule::where('is_approved', 1)->get()->map(function ($facilitySchedule) {
            return [
                'name' => $facilitySchedule->name,
                'purpose' => $facilitySchedule->purpose,
                'location' => $facilitySchedule->facility->location ?? '',
                'facility' => $facilitySchedule->facility->name ?? '',
                'calendar_color' => $facilitySchedule->facility->calendar_color ?? '#AB886D',
                'start' => Carbon::parse($facilitySchedule->start)->toISOString(),
                'end' => Carbon::parse($facilitySchedule->end)->toISOString(),
            ];
        })->toArray();
    }
    public function render()
    {
        return view('livewire.facility.calendar', [
            'facilitySchedules' => $this->facilitySchedules
        ]);
    }
}

