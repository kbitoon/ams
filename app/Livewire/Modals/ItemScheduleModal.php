<?php

namespace App\Livewire\Modals;

use App\Models\ItemSchedule;
use App\Models\Item;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\ItemScheduleForm;
use Illuminate\Database\Eloquent\Collection;


class ItemScheduleModal extends ModalComponent
{
    public ?ItemSchedule $itemSchedule = null;
    public ItemScheduleForm $form;
    public Collection $items;
    
    /**
     * @param ItemSchedule|null $itemSchedule
     */
    public function mount(ItemSchedule $itemSchedule = null): void
    {
        if ($itemSchedule && $itemSchedule->exists) {
            $this->form->setItemSchedule($itemSchedule);
        }
        $this->items = Item::all();


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
            'items' => $this->items
        ]);
    }
}
 