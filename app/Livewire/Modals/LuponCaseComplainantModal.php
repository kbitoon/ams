<?php

namespace App\Livewire\Modals;

use App\Models\LuponCaseComplainant;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\LuponCaseComplainantForm;

class LuponCaseComplainantModal extends ModalComponent
{
    use WithFileUploads;

    public ?LuponCaseComplainant $luponCaseComplainant = null;
    public LuponCaseComplainantForm $form;
   

    /**
     * @param LuponCaseComplainant|null $luponCaseComplainant
     */
    public function mount(?LuponCaseComplainant $luponCaseComplainant = null, $lupon_case_id = null): void
    {
        if ($luponCaseComplainant && $luponCaseComplainant->exists) {
            $this->form->setLuponCaseComplainant($luponCaseComplainant);
        }

        if ($lupon_case_id) {
            $this->form->setLuponCaseId($lupon_case_id);
        }
    }


    
    /**
     * Save luponCase
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
        return view('livewire.forms.lupon-case-complainant-form');
    }
}   