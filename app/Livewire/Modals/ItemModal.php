<?php

namespace App\Livewire\Modals;

use App\Models\Item;
use App\Models\ItemCategory;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\ItemForm;
use Illuminate\Database\Eloquent\Collection;


class ItemModal extends ModalComponent
{
    public ?Item $item = null;
    public ItemForm $form;
    public Collection $itemCategories;
    
    /**
     * @param Item|null $item
     */
    public function mount(Item $item = null): void
    {
        
        if ($item && $item->exists) {
            $this->form->setItem($item);
        }

        $this->itemCategories = ItemCategory::all();

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
        return view('livewire.forms.item-form', [
            'itemCategories' => $this->itemCategories,
        ]);
    }
}
