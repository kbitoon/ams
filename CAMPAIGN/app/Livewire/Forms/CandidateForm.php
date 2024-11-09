<?php

namespace App\Livewire\Forms;

use App\Models\Candidate;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class CandidateForm extends Form
{
    public ?Candidate $candidate = null;

    public string $name = '';
    public string $position = '';

    /**
     * @param Candidate|null $candidate
     */
    public function setCandidate(?Candidate $candidate = null): void
    {
        $this->candidate = $candidate;
        $this->name = $candidate->name;
        $this->position = $candidate->position;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'position' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'position' => 'position',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->candidate) {
            $candidate = Candidate::create($this->only(['name', 'position']));
        } else {
            $this->candidate->update($this->only(['name', 'position']));
        }
        $this->reset();
    }
}
