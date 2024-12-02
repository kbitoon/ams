<?php

namespace App\Livewire\Modals\Show;

use App\Models\Activity;
use LivewireUI\Modal\ModalComponent;

class ActivityModal extends ModalComponent
{
    public ?Activity $activity = null;

    public function mount(int $activity = null): void
    {
        if ($activity) {
            $this->activity = Activity::find($activity);
        }
    }

    public function render()
    {
        return view('livewire.activity.view', [
            'activity' => $this->activity,
        ]);
    }
}
