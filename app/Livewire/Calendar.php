<?php

namespace App\Livewire;

use App\Models\Activity;
use Livewire\Component;

class Calendar extends Component
{
    public $activities;

    protected $listeners = ['refreshCalendar' => '$refresh'];

    public function mount()
    {
        $this->activities = Activity::all()->map(function ($activity) {
            return [
                'id' => $activity->id,
                'title' => $activity->title,
                'start' => \Carbon\Carbon::parse($activity->start)->toISOString(),
                'end' => \Carbon\Carbon::parse($activity->end)->toISOString(),
                'description' => $activity->description,
                'location' => $activity->location,
            ];
        });
    }

    public function render()
    {
        return view('livewire.calendar', ['activities' => $this->activities]);
    }
}
