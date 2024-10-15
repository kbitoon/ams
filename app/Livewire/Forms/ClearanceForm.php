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
    public string $address = '';
    public array $attachments = [];
    public int $user_id = 1; // default to anonymous user, make sure we have this seeded

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
        $this->address = $clearance->address;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required'],
            'purpose' => ['required'],
            'type_id' => ['required'],
            'amount' => ['required'],
            'date' => ['required'],
            'contact_number' => ['required'],
            'address' => ['required'],
        ];

        // if ($this->clearance === null) {
        //     $rules['attachments'] = ['required'];
        // }

        return $rules;
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
            'address' => 'address',
            'attachments' => 'attachment',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->clearance) {
            if (auth()->user()) {
                $this->clearance = auth()->user()->clearances()->create($this->only(['name', 'purpose', 'user_id', 'type_id', 'amount', 'date', 'notes', 'contact_number','address']));
            } else {
                $this->clearance = Clearance::create($this->only(['name', 'purpose', 'user_id', 'type_id', 'amount', 'date', 'notes', 'contact_number', 'address']));
            }
        } else {
            $this->clearance->update($this->only(['name', 'purpose', 'type_id', 'amount', 'date', 'notes', 'contact_number', 'address']));

        }

        // handle file uploads, possible convert this to traits to be re-used on other entities
        foreach ($this->attachments as $attachment) {
            $id = auth()->id() ?? 1;
            $path = $attachment->storePubliclyAs('attachments/' . $id, time() . '-' . $attachment->getClientOriginalName());
            $this->clearance->assets()->create([
                'path' => $path,
            ]);
        }

        $this->reset();

        session()->flash('message', 'Request submitted successfully');
    }

}
