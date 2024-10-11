<?php

namespace App\Livewire\Forms;

use App\Models\CampaignIq;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class CampaignIqForm extends Form
{
    public ?CampaignIq $campaignIq = null;

    public string $firstname = '';
    public string $familyname = '';
    public string $birthdate = '';
    public string $address = '';
    public string $sitio = '';
    public string $barangay = '';
    public string $city = '';
    public string $province = '';
    public string $contact_number = '';
    public string $upline = '';
    public string $designation = '';
    public string $government_position = '';
    public string $sector = '';
    public string $remarks = '';

    /**
     * @param CampaignIq|null $campaignIq
     */
    public function setCampaignIq(?CampaignIq $campaignIq = null): void
    {
        $this->campaignIq = $campaignIq;
        $this->firstname = $campaignIq->firstname;
        $this->familyname = $campaignIq->familyname;
        $this->birthdate = $campaignIq->birthdate ? $campaignIq->birthdate : '';
        $this->address = $campaignIq->address;
        $this->sitio = $campaignIq->sitio;
        $this->barangay = $campaignIq->barangay;
        $this->city = $campaignIq->city;
        $this->contact_number = $campaignIq->contact_number ;
        $this->upline = $campaignIq->upline ;
        $this->designation = $campaignIq->designation;
        $this->government_position = $campaignIq->government_position;
        $this->sector = $campaignIq->sector;
        $this->remarks = $campaignIq->remarks;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'firstname' => ['required'],
            'familyname' => ['required'],
            'barangay' => ['required'],
            'contact_number' => ['required','numeric','digits:11'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'firstname' => 'firstname',
            'familyname' => 'familyname',
            'birthdate' => 'birthdate',
            'address' => 'address',
            'sitio' => 'sitio',
            'barangay' => 'barangay',
            'city' => 'city',
            'province' => 'province',
            'contact_number' => 'contact_number',
            'upline' => 'upline',
            'designation' => 'designation',
            'government_position' => 'government_position',
            'sector' => 'sector',
            'remarks' => 'remarks',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        
        if (!$this->campaignIq) {
            $campaignIq = CampaignIq::create($this->only(['firstname', 'familyname', 'birthdate', 'address', 'sitio', 'barangay', 'city', 
            'province', 'contact_number', 'upline', 'designation', 'government_position', 'sector', 'remarks']));
        } else {
            $this->campaignIq->update($this->only(['firstname', 'familyname', 'birthdate', 'address', 'sitio', 'barangay', 'city', 
            'province', 'contact_number', 'upline', 'designation', 'government_position', 'sector', 'remarks']));
        }
        $this->reset();
    }
}
