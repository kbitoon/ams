<?php

namespace App\Livewire\Modals\Show;

use App\Models\LuponCase;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class LuponCaseModal extends ModalComponent
{
    public ?LuponCase $luponCase = null;

    public function mount(LuponCase $luponCase = null): void
    {
         if ($luponCase && $luponCase->exists) {
            $this->luponCase = $luponCase->load('luponCaseComments.user', 'luponCaseComplainants', 'luponCaseRespondents');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.lupon-case.view', [
            'luponCase' => $this->luponCase,
            'luponCaseComplainants' => $this->luponCase->luponCaseComplainants ?? [],
        'luponCaseRespondents' => $this->luponCase->luponCaseRespondents ?? [],
            'luponCaseComments' => $this->luponCase->luponCaseComments ?? [],
        ]);
    }
}
