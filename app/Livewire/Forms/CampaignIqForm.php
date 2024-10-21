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
    public string $city = 'Cebu City';
    public string $province = 'Cebu';
    public string $contact_number = '';
    public string $upline = ''; 
    public string $designation = '';
    public string $government_position = '';
    public string $sector = '';
    public string $remarks = '';
    public string $status = 'Unpaid';
    public string $commitment = '';

    public string $uplineSearch = '';
    

    public function uplineOptions(): array
    {
        return CampaignIq::where(function ($query) {
            if ($this->uplineSearch) {
                $query->where('firstname', 'like', '%' . $this->uplineSearch . '%')
                      ->orWhere('familyname', 'like', '%' . $this->uplineSearch . '%');
            }
        })->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => "{$item->firstname} {$item->familyname}"
            ];
        })->toArray();
    }

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
        $this->status = $campaignIq->status;
        $this->commitment = $campaignIq->commitment ? $campaignIq->commitment : '';
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
            'contact_number' => ['numeric'],
            'birthdate' => ['nullable', 'date', 'date_format:Y-m-d'],
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
            'status' => 'status',
            'commitment' => 'commitment',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        $duplicate = CampaignIq::where('firstname', $this->firstname)
        ->where('familyname', $this->familyname)
        ->where('barangay', $this->barangay)
        ->first();

        if ($duplicate) {
        throw ValidationException::withMessages([
            'duplicate' => 'Supporter already exists.'
        ]);
        }

        $data = $this->only([
            'firstname', 'familyname', 'birthdate', 'address', 'sitio', 'barangay', 'city', 
            'province', 'contact_number', 'upline', 'designation', 'government_position', 'sector', 'remarks', 'status', 'commitment'
        ]);

        $data['birthdate'] = $this->birthdate ?: null;

        if (!$this->campaignIq) {
            CampaignIq::create($data);
        } else {
            $this->campaignIq->update($data);
        }

        $this->reset();
    }
}
