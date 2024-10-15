<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\InformationCategoryForm;
use App\Models\InformationCategory;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class InformationCategoryModal extends ModalComponent
{
    public ?InformationCategory $informationCategory = null;
    public InformationCategoryForm $form;

    /**
     * @param InformationCategory|null $informationCategory
     */
    public function mount(InformationCategory $informationCategory = null): void
    {
        if ($informationCategory && $informationCategory->exists) {
            $this->form->setInformationCategory($informationCategory);
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
        return view('livewire.forms.information-category-form');
    }
}
