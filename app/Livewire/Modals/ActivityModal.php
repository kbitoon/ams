<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ActivityForm;
use App\Models\Activity;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ActivityModal extends ModalComponent
{
    public ?Activity $activity = null;
    public ActivityForm $form;

    public function mount(Activity $activity = null): void
    {
        if ($activity && $activity->exists) {
            $this->form->setActivity($activity);
        }
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render(): View
    {
        return view('livewire.forms.activity-form', [
            'activities' => Activity::all(),
        ]);
    }
}
