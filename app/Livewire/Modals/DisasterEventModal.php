<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\DisasterEventForm;
use App\Models\DisasterEvent;
use App\Models\DisasterType;
use LivewireUI\Modal\ModalComponent;

class DisasterEventModal extends ModalComponent
{
    public ?DisasterEvent $disasterEvent = null;
    public DisasterEventForm $form;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount(DisasterEvent $event = null): void
    {
        if ($event && $event->exists) {
            $this->disasterEvent = $event;
            $this->form->setDisasterEvent($event);
        }
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render()
    {
        return view('livewire.modals.disaster-event-modal', [
            'types' => DisasterType::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
