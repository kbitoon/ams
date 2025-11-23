<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ReliefProviderForm;
use App\Models\ReliefProvider;
use LivewireUI\Modal\ModalComponent;

class ReliefProviderModal extends ModalComponent
{
    public ?ReliefProvider $reliefProvider = null;
    public ReliefProviderForm $form;

    public function mount(ReliefProvider $provider = null): void
    {
        if ($provider && $provider->exists) {
            $this->reliefProvider = $provider;
            $this->form->setReliefProvider($provider);
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
        return view('livewire.modals.relief-provider-modal');
    }
}

