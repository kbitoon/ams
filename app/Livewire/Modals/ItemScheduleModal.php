<?php

namespace App\Livewire\Modals;

use App\Models\ItemSchedule;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\ItemScheduleForm;

class ItemScheduleModal extends ModalComponent
{
    public ?ItemSchedule $itemSchedule = null;
    public ItemScheduleForm $form;
    
    /**
     * @param ItemSchedule|null $itemSchedule
     */
    public function mount(ItemSchedule $itemSchedule = null): void
    {
        if ($itemSchedule && $itemSchedule->exists) {
            $this->form->setItemSchedule($itemSchedule);
        }

    }

    /**
     * Save item
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
    public function render(): View
    {
        return view('livewire.forms.item-schedule-form', [
            'items' => ItemSchedule::all(), // Pass collection to the view
        ]);
    }
}
