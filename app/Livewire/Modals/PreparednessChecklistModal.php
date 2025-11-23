<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\PreparednessChecklistForm;
use App\Models\PreparednessChecklist;
use App\Models\DisasterType;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class PreparednessChecklistModal extends ModalComponent
{
    public ?PreparednessChecklist $checklist = null;
    public PreparednessChecklistForm $form;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount(PreparednessChecklist $checklist = null): void
    {
        if ($checklist && $checklist->exists) {
            $this->checklist = $checklist;
            $this->form->setChecklist($checklist);
        }
    }


    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render()
    {
        return view('livewire.modals.preparedness-checklist-modal', [
            'types' => DisasterType::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
