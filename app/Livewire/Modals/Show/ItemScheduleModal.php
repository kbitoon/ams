<?php

namespace App\Livewire\Modals\Show;

use App\Models\ItemSchedule;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class ItemScheduleModal extends ModalComponent
{
    public ?ItemSchedule $itemSchedule = null;

    /**
     * @param ItemSchedule|null $information
     */
    public function mount(ItemSchedule $itemSchedule = null): void
    {
        if ($itemSchedule && $itemSchedule->exists) {
            $this->itemSchedule = $itemSchedule;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.item.schedule-view', [
            'itemSchedule' => $this->itemSchedule,
        ]);
    }
}
