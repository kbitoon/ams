<?php
use App\Models\PersonalInformation;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $contact_number = '';
    public string $address = '';
    public string $sitio = '';
    public string $emergency_contact_number = '';
    public string $emergency_contact_person = '';

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
            'address' => ['required', 'max:255'],
            'sitio' => ['required', 'max:255'],
            'emergency_contact_number' => ['nullable','max:255'],
            'emergency_contact_person' => ['nullable','numeric', 'digits:11'],
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
        <select wire:model="sitio" id="sitio" name="sitio" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="" disabled>Select your Sitio</option>
        <option value="Center">Center</option>
        <option value="Common">Common</option>
        <option value="Huyong Huyong">Huyong Huyong</option>
        <option value="Lower">Lower</option>
        <option value="Sugarlandia">Sugarlandia</option>
        <option value="Upper">Upper</option>
        <option value="Villa Leyson">Villa Leyson</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('sitio')" />
    </div>

    <div>
        <x-input-label for="emergency_contact_person" :value="__('Emergency Contact Person')" />
        <x-text-input wire:model="emergency_contact_person" id="emergency_contact_person" name="emergency_contact_person" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('emergency_contact_person')" />
    </div>

    <div>
        <x-input-label for="emergency_contact_number" :value="__('Emergency Contact Number')" />
        <x-text-input wire:model="emergency_contact_number" id="emergency_contact_number" name="emergency_contact_number" type="text" class="mt-1 block w-full"/>
        <x-input-error class="mt-2" :messages="$errors->get('emergency_contact_number')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>

        <x-action-message class="me-3" on="info-updated">
            {{ __('Saved.') }}
        </x-action-message>
    </div>
</form>
</section>


