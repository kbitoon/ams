<div class="p-6 ">
    @auth
        <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
            &times;
        </button>
    @endauth
    <form wire:submit="save">
        <!-- Name input -->

        <div>
            <x-input-label for="date" :value="__('Date')" />
            <input type="date" wire:model="form.date" id="date" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" ></nput>
            <x-input-error :messages="$errors->get('form.date')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="case_no" :value="__('Case Number')" />
            <x-text-input wire:model="form.case_no" id="case_no" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.case_no')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="complaint" :value="__('Complaint')" />
            <textarea wire:model="form.complaint" id="complaint" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" ></textarea>
            <x-input-error :messages="$errors->get('form.complaint')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="prayer" :value="__('Prayer')" />
            <textarea wire:model="form.prayer" id="prayer" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" ></textarea>
            <x-input-error :messages="$errors->get('form.prayer')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="blotter_id" :value="__('Blotter')" />
            <select wire:model="form.blotter_id" id="blotter_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select a blotter</option>
                @forelse($blotters as $blotter)
                    <option value="{{ $blotter->id }}">{{ $blotter->id }}</option>
                @empty
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.blotter_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="resolution_form" :value="__('Resolution Form')" />
            <x-text-input wire:model="form.resolution_form" id="resolution_form" class="mt-1 block w-full rounded-none" type="file" multiple />
            <x-input-error :messages="$errors->get('form.resolution_form')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />
            <select wire:model="form.status" id="status" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select a status</option>
                    <option value="pending">Pending</option>
                    <option value="resolved">Resolved</option>
                    <option value="dismissed">Dismissed</option>
                    <option value="unsolved">Unsolved</option>
                    <option value="rejected">Rejected</option>
                    <option value="withdrawn">withdrawn</option>
                    <option value="solved">Solved</option>
            </select>
            <x-input-error :messages="$errors->get('form.status')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>



