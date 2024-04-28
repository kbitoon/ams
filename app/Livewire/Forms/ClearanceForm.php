<?php

namespace App\Livewire\Forms;

use App\Models\Clearance;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ClearanceForm extends Form
{
    public ?Clearance $clearance = null;

    public string $name = '';
    public string $purpose = '';
    public string $type_id = '';
    public float $amount = 0.0;
    public string $date = '';
    public string $notes = '';
    public string $contact_number = '';

    /**
     * @param Clearance|null $clearance
     */
    public function setClearance(?Clearance $clearance = null): void
    {
        $this->clearance = $clearance;
        $this->name = $clearance->name;
        $this->purpose = $clearance->purpose;
        $this->type_id = $clearance->type_id;
        $this->amount = $clearance->amount;
        $this->date = $clearance->date;
        $this->notes = $clearance->notes;
        $this->contact_number = $clearance->contact_number;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'purpose' => ['required'],
            'type_id' => ['required'],
            'amount' => ['required'],
            'date' => ['required'],
            'notes' => ['required'],
            'contact_number' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'purpose' => 'purpose',
            'type_id' => 'type',
            'amount' => 'amount',
            'date' => 'date',
            'notes' => 'notes',
            'contact_number' => 'contact number',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->clearance) {
            auth()->user()->clearances()->create($this->only(['name', 'purpose', 'user_id', 'type_id', 'amount', 'date', 'notes', 'contact_number']));
            //Clearance::create($this->only(['name', 'purpose', 'user_id', 'type_id', 'amount', 'date', 'notes', 'contact_number']));
        } else {
            $this->clearance->update($this->only(['name', 'purpose', 'type_id', 'amount', 'date', 'notes', 'contact_number']));
        }
        $this->reset();
    }

}
