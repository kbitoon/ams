<div class="p-6 max-h-[90vh] overflow-y-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $disasterReport ? 'Edit Report' : 'New Report' }}
    </h2>

    <form wire:submit="save">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="disaster_event_id" :value="__('Disaster Event')" />
                <select wire:model="form.disaster_event_id" id="disaster_event_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <option value="">Select Event</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }} ({{ $event->start_date->format('M d, Y') }})</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.disaster_event_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="report_type" :value="__('Report Type')" />
                <select wire:model="form.report_type" id="report_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <option value="situation">Situation Report</option>
                    <option value="damage_assessment">Damage Assessment</option>
                    <option value="recovery_progress">Recovery Progress</option>
                    <option value="final">Final Report</option>
                </select>
                <x-input-error :messages="$errors->get('form.report_type')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="title" :value="__('Report Title')" />
            <x-text-input wire:model="form.title" id="title" class="mt-1 block w-full" type="text" required />
            <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="report_date" :value="__('Report Date')" />
            <input type="date" wire:model="form.report_date" id="report_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            <x-input-error :messages="$errors->get('form.report_date')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="content" :value="__('Report Content')" />
            <textarea wire:model="form.content" id="content" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="12" required placeholder="Enter the report content here. You can use plain text or basic HTML formatting."></textarea>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">You can use basic HTML tags for formatting (e.g., &lt;p&gt;, &lt;strong&gt;, &lt;ul&gt;, &lt;li&gt;)</p>
            <x-input-error :messages="$errors->get('form.content')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
            <x-primary-button type="submit">Save Report</x-primary-button>
        </div>
    </form>
</div>
