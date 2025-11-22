<?php
use App\Models\PersonalInformation;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $birthdate = '';
    public string $father_firstname = '';
    public string $father_lastname = '';
    public string $mother_firstname = '';
    public string $mother_lastname = '';
    public string $blood_type = '';
    public string $willing_blood_donor = '';
    public string $occupation = '';
    public float $income = 0.0;
    public string $civil_status = '';
    public string $education = '';
    public string $financial_assistance = '';
    public string $living_in_danger_zone = '';
    public string $registered_voter = '';
    public float $weight = 0.0;
    public float $height = 0.0;

    /**
     * Mount the component with the current user information.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $userInfo = $user->personalInformation;  // Access personalInformation relationship

        // Use null coalescing operator to handle empty values
        $this->birthdate = $userInfo->birthdate ?? '';
        $this->father_firstname = $userInfo->father_firstname ?? '';
        $this->father_lastname = $userInfo->father_lastname ?? '';
        $this->mother_firstname = $userInfo->mother_firstname ?? '';
        $this->mother_lastname = $userInfo->mother_lastname ?? '';
        $this->blood_type = $userInfo->blood_type ?? '';
        $this->willing_blood_donor = $userInfo->willing_blood_donor ?? '';
        $this->occupation = $userInfo->occupation ?? '';
        $this->income = $userInfo->income ?? 0.0;
        $this->civil_status = $userInfo->civil_status ?? '';
        $this->education = $userInfo->education ?? '';
        $this->financial_assistance = $userInfo->financial_assistance ?? '';
        $this->living_in_danger_zone = $userInfo->living_in_danger_zone ?? '';
        $this->registered_voter = $userInfo->registered_voter ?? '';
        $this->weight = $userInfo->weight ?? 0.0;
        $this->height = $userInfo->height ?? 0.0;
    }

    /**
     * Update the user information.
     */
    public function updateUserInfo(): void
    {
        $validated = $this->validate([
            'birthdate' => ['nullable','string'],
            'father_firstname' => ['nullable','string', 'max:255'],
            'father_lastname' => ['nullable','string', 'max:255'],
            'mother_firstname' => ['nullable','string', 'max:255'],
            'mother_lastname' => ['nullable','string', 'max:255'],
            'blood_type' => ['nullable','string', 'max:3'],
            'willing_blood_donor' => ['nullable','string', 'max:255'],
            'occupation' => ['nullable','string', 'max:255'],
            'income' => ['nullable','numeric'],
            'civil_status' => ['nullable','string', 'max:255'],
            'education' => ['nullable','string', 'max:255'],
            'financial_assistance' => ['nullable','string', 'max:255'],
            'living_in_danger_zone' => ['nullable','string', 'max:255'],
            'registered_voter' => ['nullable','string', 'max:255'],
            'weight' => ['nullable','numeric'],
            'height' => ['nullable','numeric'],
        ]);

        $user = Auth::user();

        // Check if PersonalInformation exists; if not, create it
        if ($user->personalInformation === null) {
            $user->personalInformation()->create($validated);
        } else {
            $user->personalInformation->update($validated);
        }

        $this->dispatch('info-updated', message: 'Your information has been updated.');
    }
};?>
<section>
<header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Personal Information') }}
    </h2>
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __("Update your personal information below.") }}
    </p>
</header>

<form wire:submit="updateUserInfo" class="mt-6 space-y-6">

    <div>
        <x-input-label for="birthdate" :value="__('Birthdate')" />
        <x-text-input wire:model="birthdate" id="birthdate" name="birthdate" type="date" class="mt-1 block w-full" />
        <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
    </div>

    <div>
        <x-input-label for="father_firstname" :value="__('Father\'s First Name')" />
        <x-text-input wire:model="father_firstname" id="father_firstname" name="father_firstname" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('father_firstname')" />
    </div>

    <div>
        <x-input-label for="father_lastname" :value="__('Father\'s Last Name')" />
        <x-text-input wire:model="father_lastname" id="father_lastname" name="father_lastname" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('father_lastname')" />
    </div>

    <div>
        <x-input-label for="mother_firstname" :value="__('Mother\'s First Name')" />
        <x-text-input wire:model="mother_firstname" id="mother_firstname" name="mother_firstname" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('mother_firstname')" />
    </div>

    <div>
        <x-input-label for="mother_lastname" :value="__('Mother\'s Last Name')" />
        <x-text-input wire:model="mother_lastname" id="mother_lastname" name="mother_lastname" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('mother_lastname')" />
    </div>

    <div>
        <x-input-label for="blood_type" :value="__('Blood Type')" />
        <x-text-input wire:model="blood_type" id="blood_type" name="blood_type" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('blood_type')" />
    </div>

    <div>
        <x-input-label for="willing_blood_donor" :value="__('Willing Blood Donor')" />
        <div class="flex items-center">
            <label class="mr-2">
                <input type="radio" wire:model="willing_blood_donor" name="willing_blood_donor" value="Yes" class="mr-1">
                Yes
            </label>
            <label>
                <input type="radio" wire:model="willing_blood_donor" name="willing_blood_donor" value="No" class="mr-1">
                No
            </label>
        </div>
        <x-input-error class="mt-2" :messages="$errors->get('willing_blood_donor')" />
    </div>

    <div>
        <x-input-label for="occupation" :value="__('Occupation')" />
        <x-text-input wire:model="occupation" id="occupation" name="occupation" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('occupation')" />
    </div>

    <div>
        <x-input-label for="income" :value="__('Income')" />
        <x-text-input wire:model="income" id="income" name="income" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('income')" />
    </div>

    <div>
        <x-input-label for="civil_status" :value="__('Civil Status')" />
        <select wire:model="civil_status" id="civil_status" name="civil_status" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option selected>Select your Civil Status</option>
        <option value="Single">Single</option>
        <option value="Married">Married</option>
        <option value="Divorced">Divorced</option>
        <option value="Widowed">Widowed</option>
        <option value="Separated">Separated</option>
        <option value="Other">Other</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('civil_status')" />
    </div>

    <div>
    <x-input-label for="education" :value="__('Education')" />
    <select wire:model="education" id="education" name="education" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="" disabled>Select your Education Level</option>
        <option value="Bachelor">Bachelor</option>
        <option value="Some College">Some College</option>
        <option value="Highschool">Highschool</option>
        <option value="Elementary">Elementary</option>
        <option value="Other">Other</option>
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('education')" />
    </div>

    <div>
    <x-input-label for="financial_assistance" :value="__('Financial Assistance')" />
    <select wire:model="financial_assistance" id="financial_assistance" name="financial_assistance" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="" disabled>Select Financial Assistance Type</option>
        <option value="PWD">PWD</option>
        <option value="Senior Citizen">Senior Citizen</option>
        <option value="Social Pensioner">Social Pensioner</option>
        <option value="4Ps">4Ps</option>
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('financial_assistance')" />
    </div>


    <div>
    <x-input-label for="living_in_danger_zone" :value="__('Living in Danger Zone')" />
    <div class="flex items-center">
        <label class="mr-2">
            <input type="radio" wire:model="living_in_danger_zone" name="living_in_danger_zone" value="True" class="mr-1">
            True
        </label>
        <label>
            <input type="radio" wire:model="living_in_danger_zone" name="living_in_danger_zone" value="False" class="mr-1">
            False
        </label>
    </div>
    <x-input-error class="mt-2" :messages="$errors->get('living_in_danger_zone')" />
    </div>


    <div>
        <x-input-label for="registered_voter" :value="__('Registered Voter')" />
        <div class="flex items-center">
        <label class="mr-2">
            <input type="radio" wire:model="registered_voter" name="registered_voter" value="Yes" class="mr-1">
            Yes
        </label>
        <label>
            <input type="radio" wire:model="registered_voter" name="registered_voter" value="No" class="mr-1">
            No
        </label>
    </div>
        <x-input-error class="mt-2" :messages="$errors->get('registered_voter')" />
    </div>

    <div>
        <x-input-label for="weight" :value="__('Weight in kl.')" />
        <x-text-input wire:model="weight" id="weight" name="weight" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('weight')" />
    </div>

    <div>
        <x-input-label for="height" :value="__('Height in cm.')" />
        <x-text-input wire:model="height" id="height" name="height" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('height')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>

        <x-action-message class="me-3" on="info-updated">
            {{ __('Saved.') }}
        </x-action-message>
    </div>
</form>
</section>


