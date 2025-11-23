<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ChecklistCompletionForm;
use App\Models\PreparednessChecklist;
use App\Models\DisasterEvent;
use LivewireUI\Modal\ModalComponent;

class ChecklistCompletionModal extends ModalComponent
{
    public ?PreparednessChecklist $checklist = null;
    public ?DisasterEvent $disasterEvent = null;
    public ChecklistCompletionForm $form;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount(PreparednessChecklist $checklist = null, DisasterEvent $event = null): void
    {
        if ($checklist && $checklist->exists) {
            $this->checklist = $checklist->load('items');
            $this->form->checklist_id = $checklist->id;
        }
        
        if ($event && $event->exists) {
            $this->disasterEvent = $event;
            $this->form->disaster_event_id = $event->id;
        }
    }

    public function toggleItem($itemId)
    {
        if (in_array($itemId, $this->form->completed_items)) {
            $this->form->completed_items = array_values(array_diff($this->form->completed_items, [$itemId]));
        } else {
            $this->form->completed_items[] = $itemId;
            $this->form->completed_items = array_values($this->form->completed_items);
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
        $checklist = $this->checklist ?? PreparednessChecklist::with('items')->find($this->form->checklist_id);
        $events = DisasterEvent::where('status', 'active')->orderBy('title')->get();

        return view('livewire.modals.checklist-completion-modal', [
            'checklist' => $checklist,
            'events' => $events,
        ]);
    }
}
