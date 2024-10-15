<?php

namespace App\Livewire\Modals\Show;

use App\Models\CampaignIq;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class CampaignIqModal extends ModalComponent
{
    public ?CampaignIq $campaignIq = null;

    /**
     * @param CampaignIq|null $campaignIq
     */
    public function mount(CampaignIq $campaignIq = null): void
    {
        if ($campaignIq && $campaignIq->exists) {
            $this->campaignIq = $campaignIq;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.campaign-iq.view', [
            'campaignIq' => $this->campaignIq,
        ]);
    }
}
