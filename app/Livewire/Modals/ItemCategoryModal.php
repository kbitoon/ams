<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ItemCategoryForm;
use App\Models\ItemCategory;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ItemCategoryModal extends ModalComponent
{
    public ?ItemCategory $itemCategory = null;
    public ItemCategoryForm $form;

    /**
     * @param ItemCategory|null $itemCategory
     */
    public function mount(ItemCategory $itemCategory = null): void
    {
        if ($itemCategory && $itemCategory->exists) {
            $this->form->setItemCategory($itemCategory);
        }
    }

    /**
     * Save
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
        return view('livewire.forms.item-category-form');
    }
}
