<?php

namespace App\Livewire\Modals\Show;

use App\Models\Activity;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class ActivityModal extends ModalComponent
{
    public ?Activity $activity = null;

    /**
     * @param Activity|null $activity
     */
    public function mount(Activity $activity = null): void
    {
        if ($activity && $activity->exists) {
            $this->activity = $activity;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.activity.view', [
            'activity' => $this->activity,
        ]);
    }
}
