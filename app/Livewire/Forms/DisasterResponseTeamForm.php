<?php

namespace App\Livewire\Forms;

use App\Models\DisasterResponseTeam;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class DisasterResponseTeamForm extends Form
{
    public ?DisasterResponseTeam $team = null;

    public string $name = '';
    public string $description = '';
    public string $team_leader_id = '';
    public bool $is_active = true;
    public array $members = [];

    public function setTeam(?DisasterResponseTeam $team = null): void
    {
        $this->team = $team;
        $this->name = $team->name ?? '';
        $this->description = $team->description ?? '';
        $this->team_leader_id = $team->team_leader_id ?? '';
        $this->is_active = $team->is_active ?? true;
        
        if ($team) {
            $this->members = $team->members->map(function($member) {
                return [
                    'id' => $member->id,
                    'user_id' => $member->user_id,
                    'role' => $member->role,
                    'specialization' => $member->specialization ?? '',
                    'contact_number' => $member->contact_number ?? '',
                    'is_active' => $member->is_active,
                ];
            })->toArray();
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'team_leader_id' => ['nullable', 'exists:users,id'],
            'is_active' => ['boolean'],
            'members' => ['array'],
            'members.*.user_id' => ['required', 'exists:users,id'],
            'members.*.role' => ['required', 'in:member,deputy_leader'],
            'members.*.specialization' => ['nullable', 'string', 'max:255'],
            'members.*.contact_number' => ['nullable', 'string', 'max:255'],
            'members.*.is_active' => ['boolean'],
        ];
    }

    public function addMember(): void
    {
        $this->members[] = [
            'id' => null,
            'user_id' => '',
            'role' => 'member',
            'specialization' => '',
            'contact_number' => '',
            'is_active' => true,
        ];
    }

    public function removeMember($index): void
    {
        unset($this->members[$index]);
        $this->members = array_values($this->members);
    }

    protected function cleanFields(): void
    {
        $this->team_leader_id = $this->team_leader_id === '' ? null : $this->team_leader_id;
        $this->members = array_filter($this->members, function($member) {
            return !empty($member['user_id']);
        });
        $this->members = array_values($this->members);
    }

    public function save(): void
    {
        $this->cleanFields();
        $this->validate();

        if (!$this->team) {
            $team = DisasterResponseTeam::create($this->only([
                'name',
                'description',
                'team_leader_id',
                'is_active',
            ]));

            foreach ($this->members as $member) {
                $team->members()->create([
                    'user_id' => $member['user_id'],
                    'role' => $member['role'],
                    'specialization' => $member['specialization'] ?? null,
                    'contact_number' => $member['contact_number'] ?? null,
                    'is_active' => $member['is_active'] ?? true,
                ]);
            }
        } else {
            $this->team->update($this->only([
                'name',
                'description',
                'team_leader_id',
                'is_active',
            ]));

            $existingIds = collect($this->members)->pluck('id')->filter()->toArray();
            $this->team->members()->whereNotIn('id', $existingIds)->delete();

            foreach ($this->members as $member) {
                if (isset($member['id']) && $member['id']) {
                    $this->team->members()->where('id', $member['id'])->update([
                        'user_id' => $member['user_id'],
                        'role' => $member['role'],
                        'specialization' => $member['specialization'] ?? null,
                        'contact_number' => $member['contact_number'] ?? null,
                        'is_active' => $member['is_active'] ?? true,
                    ]);
                } else {
                    $this->team->members()->create([
                        'user_id' => $member['user_id'],
                        'role' => $member['role'],
                        'specialization' => $member['specialization'] ?? null,
                        'contact_number' => $member['contact_number'] ?? null,
                        'is_active' => $member['is_active'] ?? true,
                    ]);
                }
            }
        }

        $this->reset();
    }
}

