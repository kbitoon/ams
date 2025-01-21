<?php

namespace App\Livewire\Forms;

use App\Models\LuponCaseComplainant;
use App\Models\LuponCase;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class LuponCaseComplainantForm extends Form
{
    public ?LuponCaseComplainant $luponCaseComplainant = null;

    public string $firstname = '';
    public string $middlename = '';
    public string $lastname = '';
    public string $contact_number = '';
    public string $address = '';
    public string $lupon_case_id = '';
    /**
     * @param LuponCaseComplainant|null $luponCaseComplainant
     */
    public function setLuponCaseComplainant(?LuponCaseComplainant $luponCaseComplainant = null): void
    {
        $this->luponCaseComplainant = $luponCaseComplainant;
        $this->firstname = $luponCaseComplainant->firstname;
        $this->middlename = $luponCaseComplainant->middlename;
        $this->lastname = $luponCaseComplainant->lastname;
        $this->contact_number = $luponCaseComplainant->contact_number;
        $this->address = $luponCaseComplainant->address;
        $this->lupon_case_id = $luponCaseComplainant->lupon_case_id;
        
    }

    public function setLuponCaseId($luponCaseId): void
    {
        $this->lupon_case_id = $luponCaseId;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'firstname' => ['required'],
            'middlename' => ['required'],
            'lastname' => ['required'],
            'contact_number' => ['required','numeric'],
            'address' => ['required'],
            'lupon_case_id' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'firstname' => 'firstname',
            'middlename' => 'middlename',
            'lastname' => 'lastname',
            'contact_number' => 'contact_number',
            'address' => 'address',
            'lupon_case_id' => 'lupon_case_id',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        if (!$this->luponCaseComplainant) {
            LuponCaseComplainant::create($this->only([
                'firstname', 'middlename', 'lastname', 'contact_number', 'address', 'lupon_case_id'
            ]));
        } else {
            $this->luponCaseComplainant->update($this->only([
                'firstname', 'middlename', 'lastname', 'contact_number', 'address', 'lupon_case_id'
            ]));
        }

        $this->reset();
    }
}
