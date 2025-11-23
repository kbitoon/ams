<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ReliefDistributionForm;
use App\Models\ReliefDistribution;
use App\Models\ReliefOperation;
use App\Models\Family;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class ReliefDistributionModal extends ModalComponent
{
    public ?ReliefDistribution $reliefDistribution = null;
    public ?ReliefOperation $operation = null;
    public ReliefDistributionForm $form;
    public $selectedOperation = null;
    public string $userSearch = '';
    public $filteredUsers = [];

    public function mount(ReliefDistribution $distribution = null, ReliefOperation $operation = null): void
    {
        if ($distribution && $distribution->exists) {
            $this->reliefDistribution = $distribution;
            $this->form->setReliefDistribution($distribution);
        } elseif ($operation && $operation->exists) {
            $this->operation = $operation;
            $this->form->relief_operation_id = $operation->id;
            $this->loadSelectedOperation();
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'form.relief_operation_id') {
            $this->loadSelectedOperation();
        }
    }

    public function updatedUserSearch()
    {
        $this->filterUsers();
    }

    public function filterUsers()
    {
        $query = User::query()->orderBy('name');
        
        if ($this->userSearch) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->userSearch . '%')
                  ->orWhere('email', 'like', '%' . $this->userSearch . '%');
            });
        }
        
        $this->filteredUsers = $query->limit(10)->get();
    }

    public function selectUser($userId)
    {
        $this->form->user_id = $userId;
        $selectedUser = User::find($userId);
        $this->userSearch = $selectedUser ? $selectedUser->name : '';
        $this->filteredUsers = [];
    }

    public function loadSelectedOperation()
    {
        if ($this->form->relief_operation_id) {
            $this->selectedOperation = ReliefOperation::with('reliefItems.reliefType')
                ->find($this->form->relief_operation_id);
        } else {
            $this->selectedOperation = null;
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
        // Filter users if search is active
        if ($this->userSearch) {
            $this->filterUsers();
        } else {
            $this->filteredUsers = collect([]);
        }

        // If user_id is set, load the user name
        if ($this->form->user_id && !$this->userSearch) {
            $selectedUser = User::find($this->form->user_id);
            if ($selectedUser) {
                $this->userSearch = $selectedUser->name;
            }
        }

        return view('livewire.modals.relief-distribution-modal', [
            'operations' => ReliefOperation::orderBy('title')->get(),
            'families' => Family::with('headOfFamily', 'members.user')->orderBy('family_name')->get(),
        ]);
    }
}

