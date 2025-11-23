<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\DisasterResponseTeamForm;
use App\Models\DisasterResponseTeam;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class DisasterResponseTeamModal extends ModalComponent
{
    public ?DisasterResponseTeam $team = null;
    public DisasterResponseTeamForm $form;
    public string $leaderSearch = '';
    public $filteredLeaders = [];
    public array $memberSearches = [];
    public array $filteredMembers = [];

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount(DisasterResponseTeam $team = null): void
    {
        if ($team && $team->exists) {
            $this->team = $team;
            $this->form->setTeam($team);
            if ($team->teamLeader) {
                $this->leaderSearch = $team->teamLeader->name;
            }
            foreach ($this->form->members as $index => $member) {
                $memberUser = User::find($member['user_id'] ?? null);
                $this->memberSearches[$index] = $memberUser ? $memberUser->name : '';
            }
        } else {
            // Initialize with at least one empty member field for new teams
            if (empty($this->form->members)) {
                $this->form->addMember();
            }
        }
    }

    public function addMember()
    {
        $this->form->addMember();
        $newIndex = count($this->form->members) - 1;
        $this->memberSearches[$newIndex] = '';
        $this->filteredMembers[$newIndex] = collect([]);
    }

    public function removeMember($index)
    {
        $this->form->removeMember($index);
        unset($this->memberSearches[$index]);
        $this->memberSearches = array_values($this->memberSearches);
        unset($this->filteredMembers[$index]);
        $this->filteredMembers = array_values($this->filteredMembers);
    }

    public function updatedLeaderSearch()
    {
        $this->form->team_leader_id = '';
        $this->filterLeaders();
    }

    public function filterLeaders()
    {
        $query = User::query()->orderBy('name');
        
        if ($this->leaderSearch) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->leaderSearch . '%')
                  ->orWhere('email', 'like', '%' . $this->leaderSearch . '%');
            });
        }
        
        $this->filteredLeaders = $query->limit(10)->get();
    }

    public function selectLeader($userId)
    {
        $this->form->team_leader_id = $userId;
        $selectedUser = User::find($userId);
        $this->leaderSearch = $selectedUser ? $selectedUser->name : '';
        $this->filteredLeaders = [];
    }

    public function updatedMemberSearches($value, $index)
    {
        if (isset($this->form->members[$index])) {
            $this->form->members[$index]['user_id'] = '';
        }
        $this->filterMembers($index);
    }

    public function filterMembers($index)
    {
        $search = $this->memberSearches[$index] ?? '';
        $query = User::query()->orderBy('name');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        
        $this->filteredMembers[$index] = $query->limit(10)->get();
    }

    public function selectMember($userId, $index)
    {
        if (!in_array($userId, collect($this->form->members)->pluck('user_id')->toArray())) {
            $this->form->members[$index]['user_id'] = $userId;
            $selectedUser = User::find($userId);
            if ($selectedUser) {
                $this->memberSearches[$index] = $selectedUser->name;
            }
            $this->filteredMembers[$index] = collect([]);
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
        if ($this->leaderSearch && !$this->form->team_leader_id) {
            $this->filterLeaders();
        } else {
            $this->filteredLeaders = collect([]);
        }

        foreach ($this->memberSearches as $index => $search) {
            $memberId = $this->form->members[$index]['user_id'] ?? null;
            if ($search && !$memberId) {
                $this->filterMembers($index);
            } else {
                $this->filteredMembers[$index] = collect([]);
            }
        }

        return view('livewire.modals.disaster-response-team-modal');
    }
}
