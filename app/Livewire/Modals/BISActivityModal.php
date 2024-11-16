<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\BISActivityForm;
use App\Models\BISActivity;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class BISActivityModal extends ModalComponent
{
    public ?BISActivity $bisActivity = null;
    public BISActivityForm $form;

    public function mount(BISActivity $bisActivity = null): void
    {
        if ($bisActivity && $bisActivity->exists) {
            $this->form->setBISActivity($bisActivity);
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
            'bisActivities' => BISActivity::all(),
        ]);
    }
}
