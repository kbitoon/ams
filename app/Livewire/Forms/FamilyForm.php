<?php

namespace App\Livewire\Forms;

use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class FamilyForm extends Form
{
    public ?Family $family = null;

    public string $head_of_family_id = '';
    public string $family_name = '';
    public string $address = '';
    public string $sitio = '';
    public string $notes = '';
    public array $members = []; // Array of user_ids to add as members

    public function setFamily(?Family $family = null): void
    {
        $this->family = $family;
        $this->head_of_family_id = $family->head_of_family_id ?? '';
        $this->family_name = $family->family_name ?? '';
        $this->address = $family->address ?? '';
        $this->sitio = $family->sitio ?? '';
        $this->notes = $family->notes ?? '';
        
        if ($family) {
            $this->members = $family->members()->where('is_head', false)->pluck('user_id')->toArray();
        }
    }

    public function rules(): array
    {
        return [
            'head_of_family_id' => ['required', 'exists:users,id'],
            'family_name' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'sitio' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'members' => ['array'],
            'members.*' => ['exists:users,id'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'head_of_family_id' => 'head of family',
            'family_name' => 'family name',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        // Filter out null values and ensure head is not in members array
        $this->members = array_filter($this->members, function($value) {
            return $value !== null && $value !== '';
        });
        $this->members = array_values($this->members); // Re-index array
        $this->members = array_diff($this->members, [$this->head_of_family_id]);

        if (!$this->family) {
            $family = Family::create($this->only([
                'head_of_family_id',
                'family_name',
                'address',
                'sitio',
                'notes',
            ]));

            // Add head as a member
            FamilyMember::create([
                'family_id' => $family->id,
                'user_id' => $family->head_of_family_id,
                'relationship' => 'Head',
                'is_head' => true,
            ]);

            // Add other members
            foreach ($this->members as $userId) {
                FamilyMember::firstOrCreate([
                    'family_id' => $family->id,
                    'user_id' => $userId,
                ], [
                    'is_head' => false,
                ]);
            }
        } else {
            $this->family->update($this->only([
                'head_of_family_id',
                'family_name',
                'address',
                'sitio',
                'notes',
            ]));

            // Update head member
            FamilyMember::updateOrCreate(
                [
                    'family_id' => $this->family->id,
                    'user_id' => $this->family->head_of_family_id,
                ],
                [
                    'is_head' => true,
                    'relationship' => 'Head',
                ]
            );

            // Remove old members not in new list
            $this->family->members()
                ->where('is_head', false)
                ->whereNotIn('user_id', $this->members)
                ->delete();

            // Add new members
            foreach ($this->members as $userId) {
                FamilyMember::firstOrCreate([
                    'family_id' => $this->family->id,
                    'user_id' => $userId,
                ], [
                    'is_head' => false,
                ]);
            }
        }

        $this->reset();
    }
}

