<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <form wire:submit="save">
        <!-- Name input -->
        <div>
            <x-input-label for="firstname" :value="__('First Name')" />
            <x-text-input wire:model="form.firstname" id="firstname" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.firstname')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="familyname" :value="__('Family Name')" />
            <x-text-input wire:model="form.familyname" id="familyname" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.familyname')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="birthdate" :value="__('Birth Date')" />
            <x-input-date wire:model="form.birthdate" id="birthdate" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.birthdate')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input wire:model="form.address" id="address" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.address')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="sitio" :value="__('Sitio')" />
            <x-text-input wire:model="form.sitio" id="sitio" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.sitio')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="barangay" :value="__('Barangay')" />
            <x-text-input wire:model="form.barangay" id="barangay" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.barangay')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input wire:model="form.city" id="city" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.city')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="province" :value="__('Province')" />
            <x-text-input wire:model="form.province" id="province" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.province')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="contact_number" :value="__('Contact Number')" />
            <x-text-input wire:model="form.contact_number" id="contact_number" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.contact_number')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="upline" :value="__('Upline')" />
            <input wire:model="form.uplineSearch" id="upline" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" placeholder="Search for Upline" />
            <x-input-error :messages="$errors->get('form.upline')" class="mt-2" />

            @if ($form->uplineSearch && count($form->uplineOptions()))
                <ul class="absolute bg-white border mt-1 max-h-60 overflow-y-auto">
                    @foreach ($form->uplineOptions() as $upline)
                        <li wire:click="$set('form.upline', '{{ $upline['id'] }}')" class="cursor-pointer hover:bg-gray-200 p-2">
                            {{ $upline['name'] }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div>
            <x-input-label for="designation" :value="__('Designation')" />
            <select wire:model="form.designation" id="designation" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Select Designation</option>
                <option value="Canvasser">Canvasser</option>
                <option value="Coordinator">Coordinator</option>
                <option value="Leader">Leader</option>
                <option value="Supporter">Supporter</option>
                <option value="Volunteer">Volunteer</option>
                <option value="Other">Other</option>
            </select>
            <x-input-error :messages="$errors->get('form.designation')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="government_position" :value="__('Government Position')" />
            <select wire:model="form.government_position" id="government_position" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option selected>Select Government Position</option>
                <option value="Barangay Worker">Barangay Worker</option>
                <option value="Barangay Councilor">Barangay Councilor</option>
                <option value="Barangay Captain">Barangay Captain</option>
                <option value="Former Barangay Official">Former Barangay Official</option>
                <option value="Government Employee">Government Employee</option>
                <option value="City Official">City Official</option>
                <option value="Other">Other</option>
            </select>
            <x-input-error :messages="$errors->get('form.government_position')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="sector" :value="__('Sector')" />
            <select wire:model="form.sector" id="sector" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option selected>Select Sector</option>
                <option value="Senior">Senior</option>
                <option value="Women">Women</option>
                <option value="Solo Parents">Solo Parents</option>
                <option value="ERPAT">ERPAT</option>
                <option value="Transport">Transport</option>
                <option value="PWD">PWD</option>
                <option value="Other">Other</option>
            </select>
            <x-input-error :messages="$errors->get('form.sector')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="remarks" :value="__('Remarks')" />
            <x-text-input wire:model="form.remarks" id="remarks" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.remarks')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
