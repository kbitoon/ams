<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ClearanceTypeForm;
use App\Models\ClearanceType;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ClearanceTypeModal extends ModalComponent
{
    public ?ClearanceType $clearanceType = null;
    public ClearanceTypeForm $form;

    /**
     * @param ClearanceType|null $clearanceType
     */
    public function mount(ClearanceType $clearanceType = null): void
    {
        if ($clearanceType && $clearanceType->exists) {
            $this->form->setClearanceType($clearanceType);
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
        return view('livewire.forms.clearance-type-form');
    }
}
