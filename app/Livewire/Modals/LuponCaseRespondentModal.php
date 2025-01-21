<?php

namespace App\Livewire\Modals;

use App\Models\LuponCaseRespondent;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\LuponCaseRespondentForm;

class LuponCaseRespondentModal extends ModalComponent
{
    use WithFileUploads;

    public ?LuponCaseRespondent $luponCaseRespondent = null;
    public LuponCaseRespondentForm $form;
   

    /**
     * @param LuponCaseRespondent|null $luponCaseRespondent
     */
    public function mount(LuponCaseRespondent $luponCaseRespondent, $lupon_case_id = null): void
    {
        if ($luponCaseRespondent && $luponCaseRespondent->exists) {
            $this->form->setLuponCaseRespondent($luponCaseRespondent);
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
        return view('livewire.forms.lupon-case-respondent-form');
    }
}   