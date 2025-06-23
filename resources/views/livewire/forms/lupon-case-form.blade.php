<div class="p-6">
    @auth
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    @endauth
    <form wire:submit="save">
        <!-- Name input -->

        <div>
            <x-input-label for="blotter_search" :value="__('Search Blotter')" />
            <div class="relative">
                <input
                    type="text"
                    wire:model.live="search"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Search blotter by ID or complainant..." />

                @if($search && $filteredBlotters->count() > 0)
                <div class="absolute z-50 w-full mt-1 bg-white rounded-md shadow-lg border border-gray-200">
                    <ul class="max-h-60 overflow-auto py-1">
                        @foreach($filteredBlotters as $blotter)
                        <li>
                            <button
                                type="button"
                                wire:click="selectBlotter({{ $blotter->id }})"
                                class="w-full text-left px-4 py-2 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none {{ $form->blotter_id == $blotter->id ? 'bg-gray-100' : '' }}">
                                {{ $blotter->id }} -
                                @if($blotter->narration)
                                Complainant: {{ $blotter->firstname}} {{$blotter->lastname}}
                                @endif
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            @if($form->blotter_id)
            <div class="mt-2 p-2 bg-gray-50 rounded-md">
                <p class="text-sm text-gray-600">
                    Selected Blotter ID: {{ $form->blotter_id }}
                </p>
            </div>
            @endif
            <x-input-error :messages="$errors->get('form.blotter_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="date" :value="__('Date')" />
            <input type="date" wire:model="form.date" id="date" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text">
            <x-input-error :messages="$errors->get('form.date')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="case_no" :value="__('Case Number')" />
            <x-text-input wire:model="form.case_no" id="case_no" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.case_no')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model="form.title" id="title" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="nature" :value="__('Nature of Case')" />
            <x-text-input wire:model="form.nature" id="nature" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.nature')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="complaint" :value="__('Complaint')" />
            <textarea wire:model="form.complaint" id="complaint" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text"></textarea>
            <x-input-error :messages="$errors->get('form.complaint')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="prayer" :value="__('Prayer')" />
            <textarea wire:model="form.prayer" id="prayer" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text"></textarea>
            <x-input-error :messages="$errors->get('form.prayer')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="resolution_forms" :value="__('Resolution Form')" />
            <x-text-input wire:model="form.resolution_forms" id="resolution_forms" class="mt-1 block w-full rounded-none" type="file" multiple />
            <x-input-error :messages="$errors->get('form.resolution_forms')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />
            <select wire:model="form.status" id="status" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Please select a status</option>
                <option value="pending">Pending</option>
                <option value="settled">Settled</option>
                <option value="Referred to Higher Court">Referred to Higher Court</option>
                <option value="mediation">Mediation</option>
                <option value="Settlement Repudiation">Settlement Repudiation</option>
                <option value="Certification to File Action: 20-A">Certification to File Action: 20-A</option>
                <option value="Certification to File Action: 20-B">Certification to File Action: 20-B</option>
                <option value="Certification to Bar Action">Certification to Bar Action</option>
                <option value="Certification to Bar Counterclaim">Certification to Bar Counterclaim</option>
                <option value="Conciliated by Pangkat">Conciliated by Pangkat</option>
            </select>
            <x-input-error :messages="$errors->get('form.status')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="settled" :value="__('Settled')" />
            <select wire:model="form.settled" id="settled"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="0">False</option>
                <option value="1">True</option>
            </select>
            <x-input-error :messages="$errors->get('form.settled')" class="mt-2" />
        </div>

        @if($form->luponCase)
        <div class="mt-4">
            <x-input-label for="end" :value="__('Date Closed')" />
            <input type="date" wire:model="form.end" id="end" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <x-input-error :messages="$errors->get('form.end')" class="mt-2" />
        </div>
        @endif

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>