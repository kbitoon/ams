<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\CampaignIqForm;
use App\Models\CampaignIq;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class CampaignIqModal extends ModalComponent
{
    public ?CampaignIq $campaignIq = null;
    public CampaignIqForm $form;

    /**
     * @param CampaignIq|null $campaignIq
     */
    public function mount(CampaignIq $campaignIq = null): void
    {
        if ($campaignIq && $campaignIq->exists) {
            $this->form->setCampaignIq($campaignIq);
        }
    }

    /**
     * Save campaignIq
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
    public function render(): View{
        return view('livewire.forms.campaign-iq-form');
    }
    
}
