<?php

namespace App\Livewire\Modals;

use App\Models\Clearance;
use App\Models\ClearanceType;
use Illuminate\Contracts\View\View;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\ClearanceForm;

class ClearanceModal extends ModalComponent
{
    use WithFileUploads;

    public ?Clearance $clearance = null;
    public ClearanceForm $form;

    /**
     * @param Clearance|null $clearance
     */
    public function mount(Clearance $clearance = null): void
    {
        if ($clearance && $clearance->exists) {
            $this->form->setClearance($clearance);
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
        return view('livewire.forms.clearance-form',  [
            'clearanceTypes' => ClearanceType::all(),
        ]);
    }
}
