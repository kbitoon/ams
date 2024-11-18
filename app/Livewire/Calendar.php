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
                'title' => $activity->title,
                'start' => \Carbon\Carbon::parse($activity->start)->toISOString(),
                'end' => \Carbon\Carbon::parse($activity->end)->toISOString(),
            ];
        });
    }

    public function render()
    {
        return view('livewire.calendar', ['activities' => $this->activities]);
    }

}
