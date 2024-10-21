<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <form wire:submit="save">
        <!-- Name input -->
        <div class="mt-4">
            <x-input-label for="firstname" :value="__('First Name')" />
            <x-text-input wire:model="form.firstname" id="firstname" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.firstname')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="familyname" :value="__('Last Name')" />
            <x-text-input wire:model="form.familyname" id="familyname" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.familyname')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="birthdate" :value="__('Date of Birth')" />
            <x-text-input wire:model="form.birthdate" id="birthdate" class="mt-1 block w-full" type="text" placeholder="yyyy-mm-dd" />
            <x-input-error :messages="$errors->get('form.birthdate')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input wire:model="form.address" id="address" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.address')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="sitio" :value="__('Sitio')" />
            <x-text-input wire:model="form.sitio" id="sitio" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.sitio')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="barangay" :value="__('Barangay')" />
            <select wire:model="form.barangay" id="barangay" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option selected>Select Barangay</option>
                <option value="Adlaon">Adlaon</option>
                <option value="Agsungot">Agsungot</option>
                <option value="Apas">Apas</option>
                <option value="Bacayan">Bacayan</option>
                <option value="Banilad">Banilad</option>
                <option value="Binaliw">Binaliw</option>
                <option value="Budlaan">Budlaan</option>
                <option value="Busay">Busay</option>
                <option value="Cambinocot">Cambinocot</option>
                <option value="Capitol Site">Capitol Site</option>
                <option value="Carreta">Carreta</option>
                <option value="Cogon Ramos">Cogon Ramos</option>
                <option value="Day‑as">Day‑as</option>
                <option value="Ermita">Ermita</option>
                <option value="Guba">Guba</option>
                <option value="Hipodromo">Hipodromo</option>
                <option value="Kalubihan">Kalubihan</option>
                <option value="Kamagayan">Kamagayan</option>
                <option value="Kamputhaw">Kamputhaw</option>
                <option value="Kasambagan">Kasambagan</option>
                <option value="Lahug">Lahug</option>
                <option value="Lorega San Miguel">Lorega San Miguel</option>
                <option value="Lusaran">Lusaran</option>
                <option value="Luz">Luz</option>
                <option value="Mabini">Mabini</option>
                <option value="Mabolo">Mabolo</option>
                <option value="Malubog">Malubog</option>
                <option value="Pahina Central">Pahina Central</option>
                <option value="Pari-an">Pari-an</option>
                <option value="Paril">Paril</option>
                <option value="Pit-os">Pit-os</option>
                <option value="Pulangbato">Pulangbato</option>
                <option value="Sambag I">Sambag I</option>
                <option value="Sambag II">Sambag II</option>
                <option value="San Antonio">San Antonio</option>
                <option value="San Jose">San Jose</option>
                <option value="San Roque">San Roque</option>
                <option value="Santa Cruz">Santa Cruz</option>
                <option value="Santo Niño">Santo Niño</option>
                <option value="Sirao">Sirao</option>
                <option value="T. Padilla">T. Padilla</option>
                <option value="Talamban">Talamban</option>
                <option value="Taptap">Taptap</option>
                <option value="Tejero">Tejero</option>
                <option value="Tinago">Tinago</option>
                <option value="Zapatera">Zapatera</option>
            </select>
            <x-input-error :messages="$errors->get('form.barangay')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="city" :value="__('City')" />
            <x-text-input wire:model="form.city" id="city" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.city')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="province" :value="__('Province')" />
            <x-text-input wire:model="form.province" id="province" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.province')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="contact_number" :value="__('Contact Number')" />
            <x-text-input wire:model="form.contact_number" id="contact_number" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.contact_number')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="upline" :value="__('Upline')" />
            <input wire:model.live.debounce.500ms="form.uplineSearch" id="upline" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" placeholder="Search for Upline" />
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

        <div class="mt-4">
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
        <div class="mt-4">
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
        <div class="mt-4">
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
        
        <div class="mt-4">
            <x-input-label for="remarks" :value="__('Remarks')" />
            <x-text-input wire:model="form.remarks" id="remarks" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.remarks')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="commitment" :value="__('Commitment')" />
            
            <label class="inline-flex items-center mt-1 mr-5">
                <input type="radio" wire:model="form.commitment" value="Yes" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Yes</span>
            </label>

            <label class="inline-flex items-center mt-1 mr-5">
                <input type="radio" wire:model="form.commitment" value="Neither" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Neither</span>
            </label>
            
            <label class="inline-flex items-center mt-1 mr-5">
                <input type="radio" wire:model="form.commitment" value="No" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">No</span>
            </label>

            <x-input-error :messages="$errors->get('form.commitment')" class="mt-2" />
        </div>
        
        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
