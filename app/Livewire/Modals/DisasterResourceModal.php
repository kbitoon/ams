<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\DisasterResourceForm;
use App\Models\DisasterResource;
use App\Models\DisasterEvent;
use App\Models\DisasterResponseTeam;
use LivewireUI\Modal\ModalComponent;

class DisasterResourceModal extends ModalComponent
{
    public ?DisasterResource $resource = null;
    public DisasterResourceForm $form;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount(DisasterResource $resource = null): void
    {
        if ($resource && $resource->exists) {
            $this->resource = $resource;
            $this->form->setResource($resource);
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
        return view('livewire.modals.disaster-resource-modal', [
            'events' => DisasterEvent::orderBy('title')->get(),
            'teams' => DisasterResponseTeam::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
