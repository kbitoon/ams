<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ActivityForm;
use App\Models\Activity;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;

class ActivityModal extends ModalComponent
{
    use WithFileUploads;

    public ?Activity $activity = null;
    public ActivityForm $form;

    /**
     * @param Activity|null $activity
     */
    public function mount(Activity $activity = null): void
    {
        if ($activity && $activity->exists) {
            $this->form->setActivity($activity);
        }
    }

    /**
     * Save clearance
     */
    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    /**
     * @return View
     */
    public function render() : View
    {
        return view('livewire.forms.activity-form');
    }
}

