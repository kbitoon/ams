<?php

namespace App\Livewire\Forms;

use App\Models\User;
use App\Models\PersonalInformation;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user = null;

    public string $name = '';
    public string $email = '';
    public ?string $roles = null;

    // Personal Information fields
    public string $contact_number = '';
    public string $birthdate = '';
    public string $father_firstname = '';
    public string $father_lastname = '';
    public string $mother_firstname = '';
    public string $mother_lastname = '';
    public string $address = '';
    public string $sitio = '';
    public string $blood_type = '';
    public string $willing_blood_donor = '';
    public string $occupation = '';
    public float $income = 0.0;
    public string $civil_status = '';
    public string $education = '';
    public string $financial_assistance = '';
    public string $living_in_danger_zone = '';
    public string $registered_voter = '';
    public string $emergency_contact_person = '';
    public string $emergency_contact_number = '';
    public float $weight = 0.0;
    public float $height = 0.0;

    /**
     * Set the user data into the form.
     *
     * @param User|null $user
     */
    public function setUser(?User $user = null): void
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roles = $user->roles->first()?->name;

        // Load personal information if exists
        $personalInfo = $user->personalInformation;
        if ($personalInfo) {
            $this->contact_number = $personalInfo->contact_number ?? '';
            $this->birthdate = $personalInfo->birthdate ?? '';
            $this->father_firstname = $personalInfo->father_firstname ?? '';
            $this->father_lastname = $personalInfo->father_lastname ?? '';
            $this->mother_firstname = $personalInfo->mother_firstname ?? '';
            $this->mother_lastname = $personalInfo->mother_lastname ?? '';
            $this->address = $personalInfo->address ?? '';
            $this->sitio = $personalInfo->sitio ?? '';
            $this->blood_type = $personalInfo->blood_type ?? '';
            $this->willing_blood_donor = $personalInfo->willing_blood_donor ?? '';
            $this->occupation = $personalInfo->occupation ?? '';
            $this->income = $personalInfo->income ?? 0.0;
            $this->civil_status = $personalInfo->civil_status ?? '';
            $this->education = $personalInfo->education ?? '';
            $this->financial_assistance = $personalInfo->financial_assistance ?? '';
            $this->living_in_danger_zone = $personalInfo->living_in_danger_zone ?? '';
            $this->registered_voter = $personalInfo->registered_voter ?? '';
            $this->emergency_contact_person = $personalInfo->emergency_contact_person ?? '';
            $this->emergency_contact_number = $personalInfo->emergency_contact_number ?? '';
            $this->weight = $personalInfo->weight ?? 0.0;
            $this->height = $personalInfo->height ?? 0.0;
        }
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'roles' => ['nullable', 'exists:roles,name'],
            'contact_number' => ['nullable', 'string', 'max:11'],
            'birthdate' => ['nullable', 'string'],
            'father_firstname' => ['nullable', 'string', 'max:255'],
            'father_lastname' => ['nullable', 'string', 'max:255'],
            'mother_firstname' => ['nullable', 'string', 'max:255'],
            'mother_lastname' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'sitio' => ['nullable', 'string', 'max:255'],
            'blood_type' => ['nullable', 'string', 'max:3'],
            'willing_blood_donor' => ['nullable', 'string', 'max:255'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'income' => ['nullable', 'numeric'],
            'civil_status' => ['nullable', 'string', 'max:255'],
            'education' => ['nullable', 'string', 'max:255'],
            'financial_assistance' => ['nullable', 'string', 'max:255'],
            'living_in_danger_zone' => ['nullable', 'string', 'max:255'],
            'registered_voter' => ['nullable', 'string', 'max:255'],
            'emergency_contact_person' => ['nullable', 'string', 'max:255'],
            'emergency_contact_number' => ['nullable', 'string', 'max:255'],
            'weight' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        if (!$this->user) {
            $user = User::create($this->only(['name', 'email']));
        } else {
            $this->user->update($this->only(['name', 'email']));
            $user = $this->user;
        }

        if ($this->roles) {
            $user->syncRoles([$this->roles]);
        } else {
            $user->syncRoles([]);
        }

        // Save or update personal information
        $personalInfoData = [
            'contact_number' => $this->contact_number,
            'birthdate' => $this->birthdate,
            'father_firstname' => $this->father_firstname,
            'father_lastname' => $this->father_lastname,
            'mother_firstname' => $this->mother_firstname,
            'mother_lastname' => $this->mother_lastname,
            'address' => $this->address,
            'sitio' => $this->sitio,
            'blood_type' => $this->blood_type,
            'willing_blood_donor' => $this->willing_blood_donor,
            'occupation' => $this->occupation,
            'income' => $this->income,
            'civil_status' => $this->civil_status,
            'education' => $this->education,
            'financial_assistance' => $this->financial_assistance,
            'living_in_danger_zone' => $this->living_in_danger_zone,
            'registered_voter' => $this->registered_voter,
            'emergency_contact_person' => $this->emergency_contact_person,
            'emergency_contact_number' => $this->emergency_contact_number,
            'weight' => $this->weight,
            'height' => $this->height,
        ];

        if ($user->personalInformation) {
            $user->personalInformation->update($personalInfoData);
        } else {
            $user->personalInformation()->create($personalInfoData);
        }

        $this->reset();
    }
}
