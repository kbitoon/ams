<?php

namespace App\Livewire\Forms;

use App\Models\LuponCaseRespondent;
use App\Models\LuponCase;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class LuponCaseRespondentForm extends Form
{
    public ?LuponCaseRespondent $luponCaseRespondent = null;

    public string $firstname = '';
    public string $middlename = '';
    public string $lastname = '';
    public string $contact_number = '';
    public string $address = '';
    public string $lupon_case_id = '';
    /**
     * @param LuponCaseRespondent|null $luponCaseRespondent
     */
    public function setLuponCaseRespondent(?LuponCaseRespondent $luponCaseRespondent = null): void
    {
        $this->luponCaseRespondent = $luponCaseRespondent;
        $this->firstname = $luponCaseRespondent->firstname;
        $this->middlename = $luponCaseRespondent->middlename;
        $this->lastname = $luponCaseRespondent->lastname;
        $this->contact_number = $luponCaseRespondent->contact_number;
        $this->address = $luponCaseRespondent->address;
        $this->lupon_case_id = $luponCaseRespondent->lupon_case_id;
        
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
            'middlename' => ['nullable'],
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

        if (!$this->luponCaseRespondent) {
            LuponCaseRespondent::create($this->only(['firstname', 'middlename', 'lastname',  'contact_number','address', 'lupon_case_id']));
        } else {
            $this->luponCaseRespondent->update($this->only(['firstname', 'middlename', 'lastname',  'contact_number','address', 'lupon_case_id']));
        }
        
        $this->reset();
    }
}
