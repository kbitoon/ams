<?php
use App\Models\PersonalInformation;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $contact_number = '';
    public string $address = '';
    public string $sitio = '';
    public string $emergency_contact_1 = '';
    public string $emergency_contact_2 = '';

    /**
     * Mount the component with the current user information.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $userInfo = $user->personalInformation;  // Access personalInformation relationship

        // Use null coalescing operator to handle empty values
        $this->contact_number = $userInfo->contact_number ?? '';
        $this->address = $userInfo->address ?? '';
        $this->sitio = $userInfo->sitio ?? '';
        $this->emergency_contact_1 = $userInfo->emergency_contact_1 ?? '';
        $this->emergency_contact_2 = $userInfo->emergency_contact_2 ?? '';
    }

    /**
     * Update the user information.
     */
    public function updateUserInfo(): void
    {
        $validated = $this->validate([
            'contact_number' => ['required', 'digits:11'],
            'address' => ['required','string', 'max:255'],
            'sitio' => ['required','string', 'max:255'],
            'emergency_contact_1' => ['required','numeric', 'digits:11'],
            'emergency_contact_2' => ['required','numeric', 'digits:11'],
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
        {{ __('Contact Information') }}
    </h2>
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __("Update your contact information below.") }}
    </p>
</header>

<form wire:submit="updateUserInfo" class="mt-6 space-y-6">
  
    <div>
        <x-input-label for="contact_number" :value="__('Contact Number')" />
        <x-text-input wire:model="contact_number" id="contact_number" name="contact_number" type="text" class="mt-1 block w-full" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
    </div>

    <div>
        <x-input-label for="address" :value="__('Address')" />
        <x-text-input wire:model="address" id="address" name="address" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('address')" />
    </div>

    <div>
        <x-input-label for="sitio" :value="__('Sitio')" />
        <x-text-input wire:model="sitio" id="sitio" name="sitio" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('sitio')" />
    </div>

    <div>
        <x-input-label for="emergency_contact_1" :value="__('Emergency Contact 1')" />
        <x-text-input wire:model="emergency_contact_1" id="emergency_contact_1" name="emergency_contact_1" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('emergency_contact_1')" />
    </div>

    <div>
        <x-input-label for="emergency_contact_2" :value="__('Emergency Contact 2')" />
        <x-text-input wire:model="emergency_contact_2" id="emergency_contact_2" name="emergency_contact_2" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('emergency_contact_2')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>

        <x-action-message class="me-3" on="info-updated">
            {{ __('Saved.') }}
        </x-action-message>
    </div>
</form>
</section>


