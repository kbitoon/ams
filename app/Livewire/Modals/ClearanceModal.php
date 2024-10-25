<?php

namespace App\Livewire\Modals;

use App\Models\Clearance;
use App\Models\ClearanceType;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\ClearanceForm;

class ClearanceModal extends ModalComponent
{
    use WithFileUploads;

    public ?Clearance $clearance = null;
    public ClearanceForm $form;
   

    public string $requirement = ''; // Add a property to hold the requirement

    /**
     * @param Clearance|null $clearance
     */
    public function mount(Clearance $clearance = null): void
    {
        if ($clearance && $clearance->exists) {
            $this->form->setClearance($clearance);
        }

        $this->clearanceTypes = ClearanceType::orderBy('name')->get();
    }

    /**
     * Automatically updates the amount and requirement fields based on the selected type.
     *
     * @param $value
     */
    public function updatedFormTypeId($value)
    {
        $clearanceType = $this->clearanceTypes->first(function($item) use ($value) {
            return $item->id == $value;
        });

        if ($clearanceType) {
            $this->form->amount = $clearanceType->amount;
            $this->requirement = empty($clearanceType->requirement) ? '' : $clearanceType->requirement;
        } else {
            $this->form->amount = 0;
            $this->requirement = '';
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

        if (!auth()->user()) {
            session()->flash('status', 'Clearance successfully requested.');
            $this->redirectRoute('get-a-clearance');
        }
    }

    /**
     * @return View
     */
    public function render() : View
    {
        return view('livewire.forms.clearance-form',  [
            'clearanceTypes' => $this->clearanceTypes,
            'requirement' => $this->requirement,
        ]);
    }
}
