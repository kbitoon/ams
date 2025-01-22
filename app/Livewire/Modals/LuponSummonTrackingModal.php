<?php

namespace App\Livewire\Modals;

use App\Models\LuponSummonTracking;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\LuponSummonTrackingForm;

class LuponSummonTrackingModal extends ModalComponent
{
    use WithFileUploads;

    public ?LuponSummonTracking $luponSummonTracking = null;
    public LuponSummonTrackingForm $form;
   

    /**
     * @param LuponSummonTracking|null $luponSummonTracking
     */
    public function mount(LuponSummonTracking $luponSummonTracking = null, $lupon_case_id = null): void
    {
        if ($luponSummonTracking && $luponSummonTracking->exists) {
            $this->form->setLuponSummonTracking($luponSummonTracking);
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
        return view('livewire.forms.lupon-summon-tracking-form');
    }
}   