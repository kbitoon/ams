<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\EvacuationCenterForm;
use App\Models\EvacuationCenter;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class EvacuationCenterModal extends ModalComponent
{
    public ?EvacuationCenter $evacuationCenter = null;
    public EvacuationCenterForm $form;
    public string $contactSearch = '';
    public $filteredContacts = [];

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount(EvacuationCenter $center = null): void
    {
        if ($center && $center->exists) {
            $this->evacuationCenter = $center;
            $this->form->setEvacuationCenter($center);
            if ($center->contactPerson) {
                $this->contactSearch = $center->contactPerson->name;
            }
        }
    }

    public function updatedContactSearch()
    {
        $this->form->contact_person_id = '';
        $this->filterContacts();
    }

    public function filterContacts()
    {
        $query = User::query()->orderBy('name');
        
        if ($this->contactSearch) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->contactSearch . '%')
                  ->orWhere('email', 'like', '%' . $this->contactSearch . '%');
            });
        }
        
        $this->filteredContacts = $query->limit(10)->get();
    }

    public function selectContact($userId)
    {
        $this->form->contact_person_id = $userId;
        $selectedUser = User::find($userId);
        $this->contactSearch = $selectedUser ? $selectedUser->name : '';
        $this->filteredContacts = [];
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render()
    {
        if ($this->contactSearch && !$this->form->contact_person_id) {
            $this->filterContacts();
        } else {
            $this->filteredContacts = collect([]);
        }

        return view('livewire.modals.evacuation-center-modal');
    }
}
