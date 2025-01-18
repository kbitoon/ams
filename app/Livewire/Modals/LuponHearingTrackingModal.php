<?php

namespace App\Livewire\Modals;

use App\Models\LuponHearingTracking;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\LuponCaseForm;

class LuponHearingTrackingModal extends ModalComponent
{
    use WithFileUploads;

    public ?LuponHearingTracking $luponHearingTracking = null;
    public LuponHearingTrackingForm $form;
   

    /**
     * @param LuponHearingTracking|null $luponHearingTracking
     */
    public function mount(LuponHearingTracking $luponHearingTracking = null): void
    {
        if ($luponHearingTracking && $luponHearingTracking->exists) {
            $this->form->setLuponHearingTracking($luponHearingTracking);
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
        return view('livewire.forms.lupon-hearing-tracking-form',  [
            'luponHearingTrackings' => $this -> luponHearingTrackings
        ]);
    }
}   