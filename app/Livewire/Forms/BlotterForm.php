<?php

namespace App\Livewire\Forms;

use App\Models\Blotter;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class BlotterForm extends Form
{
    public ?Blotter $blotter = null;

    public string $reported = '';
    public string $incident = '';
    public string $place = '';
    public string $lastname = '';
    public string $firstname = '';
    public string $middle = '';
    public string $contact = '';
    public string $civil = '';
    public string $date_of_birth = '';
    public string $address = '';
    public string $place_of_birth = '';
    public string $occupation = '';
    public string $narration = '';


    /**
     * @param Blotter|null $blotter
     */
    public function setBlotter(?Blotter $blotter = null): void
    {
        $this->blotter = $blotter;
        $this->reported = $blotter->reported;
        $this->incident = $blotter->incident;
        $this->place = $blotter->place;
        $this->lastname = $blotter->lastname;
        $this->firstname = $blotter->firstname;
        $this->middle = $blotter->middle;
        $this->contact = $blotter->contact;
        $this->civil = $blotter->civil;
        $this->date_of_birth = $blotter->date_of_birth;
        $this->address = $blotter->address;
        $this->place_of_birth = $blotter->place_of_birth;
        $this->occupation = $blotter->occupation;
        $this->narration = $blotter->narration;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'reported' => ['required'],
            'incident' => ['required', 'date'],
            'place' => ['required'],
            'lastname' => ['required'],
            'firstname' => ['required'],
            'middle' => ['required'],
            'contact' => ['required'],
            'civil' => ['required'],
            'date_of_birth' => ['required', ],
            'address' => ['required'],
            'narration' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'reported' => 'reported',
            'incident' => 'incident',
            'place' => 'place',
            'lastname' => 'lastname',
            'firstname' => 'firstname',
            'middle' => 'middle',
            'contact' => 'contact',
            'civil' => 'civil',
            'date_of_birth' => 'date_of_birth',
            'address' => 'address',
            'occupation' => 'occupation',
            'narration' => 'narration',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->blotter) {
            if (auth()->user()) {
            $this->blotter = auth()->user()->blotters()->create($this->only(['user_id','reported','incident','place','lastname', 'firstname', 'middle','contact','civil','date_of_birth','address','occupation','narration']));
        } else {
            $this->blotter->update($this->only(['reported','incident','place','lastname', 'firstname', 'middle','contact','civil','date_of_birth','address','occupation','narration','complainee_id']));
        }
        $this->reset();
        }
    }
}