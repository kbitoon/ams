<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\InformationForm;
use App\Models\Information;
use App\Models\InformationCategory;
use Illuminate\Contracts\View\View;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class InformationModal extends ModalComponent
{
    use WithFileUploads;

    public ?Information $information = null;
    public InformationForm $form;

    /**
     * @param Information|null $information
     */
    public function mount(Information $information = null): void
    {
        if ($information && $information->exists) {
            $this->form->setInformation($information);
        }
    }

    /**
     * Save clearance
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
        return view('livewire.forms.information-form',[
            'informationCategories' => InformationCategory::all(),
        ]);
    }
}
