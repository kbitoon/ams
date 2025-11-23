<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\FamilyForm;
use App\Models\Family;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class FamilyModal extends ModalComponent
{
    public ?Family $family = null;
    public FamilyForm $form;
    public string $headSearch = '';
    public $filteredHeadUsers = [];
    public array $memberSearches = [];
    public array $filteredMemberUsers = [];

    public function mount(Family $family = null): void
    {
        if ($family && $family->exists) {
            $this->family = $family;
            $this->form->setFamily($family);
            // Initialize member searches for existing members
            foreach ($this->form->members as $index => $memberId) {
                $member = User::find($memberId);
                if ($member) {
                    $this->memberSearches[$index] = $member->name;
                }
            }
        }
    }

    public function updatedHeadSearch()
    {
        $this->filterHeadUsers();
    }

    public function filterHeadUsers()
    {
        $query = User::query()->orderBy('name');
        
        if ($this->headSearch) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->headSearch . '%')
                  ->orWhere('email', 'like', '%' . $this->headSearch . '%');
            });
        }
        
        $this->filteredHeadUsers = $query->limit(10)->get();
    }

    public function selectHead($userId)
    {
        $this->form->head_of_family_id = $userId;
        $selectedUser = User::find($userId);
        $this->headSearch = $selectedUser ? $selectedUser->name : '';
        $this->filteredHeadUsers = [];
    }

    public function updatedMemberSearches($value, $key)
    {
        // If user is typing and a member is already selected, clear the selection
        $memberId = $this->form->members[$key] ?? null;
        if ($memberId && $value !== '') {
            // Check if the typed value matches the selected member's name
            $selectedMember = User::find($memberId);
            if ($selectedMember && strtolower($value) !== strtolower($selectedMember->name)) {
                // User is typing something different, clear the selection
                $this->form->members[$key] = null;
            }
        }
        $this->filterMemberUsers($key);
    }

    public function filterMemberUsers($index)
    {
        $search = $this->memberSearches[$index] ?? '';
        $query = User::query()->orderBy('name');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        
        $this->filteredMemberUsers[$index] = $query->limit(10)->get();
    }

    public function selectMember($userId, $index)
    {
        // Check if user is already in members (excluding current index)
        $existingIndex = array_search($userId, $this->form->members);
        if ($existingIndex !== false && $existingIndex !== $index) {
            // User already exists in another slot, don't allow duplicate
            return;
        }
        
        // Set the member at this index
        $this->form->members[$index] = $userId;
        
        $selectedUser = User::find($userId);
        if ($selectedUser) {
            // Set the search to the user's name (this will be displayed in the input)
            $this->memberSearches[$index] = $selectedUser->name;
        }
        // Clear the filtered users to hide dropdown
        $this->filteredMemberUsers[$index] = collect([]);
    }

    public function removeMember($index)
    {
        unset($this->form->members[$index]);
        $this->form->members = array_values($this->form->members);
        unset($this->memberSearches[$index]);
        unset($this->filteredMemberUsers[$index]);
    }

    public function addMemberField()
    {
        // Add an empty placeholder to members array
        $this->form->members[] = null;
        $newIndex = count($this->form->members) - 1;
        $this->memberSearches[$newIndex] = '';
        $this->filteredMemberUsers[$newIndex] = collect([]);
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render()
    {
        // Filter head users if search is active
        if ($this->headSearch) {
            $this->filterHeadUsers();
        } else {
            $this->filteredHeadUsers = collect([]);
        }

        // If head_of_family_id is set, load the user name
        if ($this->form->head_of_family_id && !$this->headSearch) {
            $selectedUser = User::find($this->form->head_of_family_id);
            if ($selectedUser) {
                $this->headSearch = $selectedUser->name;
            }
        }

        // Filter member users - only show dropdown if no member is selected at that index
        foreach ($this->memberSearches as $index => $search) {
            $memberId = $this->form->members[$index] ?? null;
            if ($memberId) {
                // If member is selected, check if search text matches the member's name
                $member = User::find($memberId);
                if ($member && $search === $member->name) {
                    // Search matches selected member, don't show dropdown
                    $this->filteredMemberUsers[$index] = collect([]);
                } elseif ($search && $search !== ($member ? $member->name : '')) {
                    // User is typing something different, filter users
                    $this->filterMemberUsers($index);
                } else {
                    $this->filteredMemberUsers[$index] = collect([]);
                }
            } elseif ($search) {
                // No member selected, filter users
                $this->filterMemberUsers($index);
            } else {
                $this->filteredMemberUsers[$index] = collect([]);
            }
        }

        return view('livewire.modals.family-modal');
    }
}

