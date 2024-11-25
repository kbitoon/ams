<?php

namespace App\Livewire\Forms;

use App\Models\Complainee;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ComplaineeForm extends Form
{
    public ?Complainee $complainee = null;

    public string $last = '';
    public string $first = '';
    public string $middle = '';
    public string $contact = '';
    public string $civil_status = '';
    public string $date_of_birth = '';
    public string $address = '';
    public string $place_of_birth = '';
    public string $occupation = '';
    public string $influence = '';


    /**
     * @param Complainee|null $complainee
     */
    public function setComplainee(?Complainee $complainee = null): void
    {
        $this->complainee = $complainee;
        $this->last = $complainee->last;
        $this->first = $complainee->first;
        $this->middle = $complainee->middle;
        $this->contact = $complainee->contact;
        $this->civil_status = $complainee->civil_status;
        $this->date_of_birth = $complainee->date_of_birth;
        $this->address = $complainee->address;
        $this->place_of_birth = $complainee->place_of_birth;
        $this->occupation = $complainee->occupation;
        $this->influence = $complainee->influence;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'last' => ['required'],
            'first' => ['required'],
            'middle' => ['required'],
            'contact' => ['required'],
            'civil_status' => ['required'],
            'date_of_birth' => ['required', ],
            'address' => ['required'],
            'place_of_birth' => ['required'],
            'occupation' => ['required'],
            'influence' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'last' => 'last',
            'first' => 'first',
            'middle' => 'middle',
            'contact' => 'contact',
            'civil_status' => 'civil_status',
            'date_of_birth' => 'date_of_birth',
            'address' => 'address',
            'occupation' => 'occupation',
            'place_of_birth' => 'place_of_birth',
            'influence' => 'influence',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->complainee) {
            if (auth()->user()) {
            $this->complainee = auth()->user()->complainees()->create($this->only(['user_id','reported','incident','place','lastname', 'firstname', 'middle','contact','civil','date_of_birth','occupation','narration','recorded_by']));
            } else {
            $complainee = Complainee::create($this->only(['user_id','reported','incident','place','lastname', 'firstname', 'middle','contact','civil','date_of_birth','occupation','narration','recorded_by']));
            }
        } else {
            $this->complainee->update($this->only(['reported','incident','place','lastname', 'firstname', 'middle','contact','civil','date_of_birth','occupation','narration','recorded_by','complainee_id']));
        }
        $this->reset();
    }
}