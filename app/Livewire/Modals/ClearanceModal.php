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
    public Collection $clearanceTypes;

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
     * Automatically updates the amount field based on type
     *
     * @param $value
     */
    public function updatedFormTypeId($value)
    {
        $clearanceType = $this->clearanceTypes->first(function($item) use ($value) {
            return $item->id == $value;
        });

        $this->form->amount = $clearanceType->amount;
    }

    /**
     * Save clearance
     */
    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatchBrowserEvent('clearance-updated'); 

        if (!auth()->user()) {
            session()->flash('status', 'Clearance successfully requested.');
            $this->redirectRoute('home');
        }
    }

    /**
     * @return View
     */
    public function render() : View
    {
        return view('livewire.forms.clearance-form',  [
            'clearanceTypes' => $this->clearanceTypes,
        ]);
    }
}
