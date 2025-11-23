<div class="p-6 max-h-[90vh] overflow-y-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $activity ? 'Edit Recovery Activity' : 'New Recovery Activity' }}
    </h2>

    <form wire:submit="save">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="disaster_event_id" :value="__('Disaster Event')" />
                <select wire:model="form.disaster_event_id" id="disaster_event_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <option value="">Select Event</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.disaster_event_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="activity_type" :value="__('Activity Type')" />
                <select wire:model="form.activity_type" id="activity_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="cleanup">Cleanup</option>
                    <option value="reconstruction">Reconstruction</option>
                    <option value="rehabilitation">Rehabilitation</option>
                    <option value="assistance_distribution">Assistance Distribution</option>
                    <option value="infrastructure_repair">Infrastructure Repair</option>
                    <option value="other">Other</option>
                </select>
                <x-input-error :messages="$errors->get('form.activity_type')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model="form.title" id="title" class="mt-1 block w-full" type="text" required />
            <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description (Optional)')" />
            <textarea wire:model="form.description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="3"></textarea>
            <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="start_date" :value="__('Start Date')" />
                <input type="date" wire:model="form.start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                <x-input-error :messages="$errors->get('form.start_date')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="status" :value="__('Status')" />
                <select wire:model="form.status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="planned">Planned</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <x-input-error :messages="$errors->get('form.status')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="target_completion_date" :value="__('Target Completion Date (Optional)')" />
                <input type="date" wire:model="form.target_completion_date" id="target_completion_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <x-input-error :messages="$errors->get('form.target_completion_date')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="actual_completion_date" :value="__('Actual Completion Date (Optional)')" />
                <input type="date" wire:model="form.actual_completion_date" id="actual_completion_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <x-input-error :messages="$errors->get('form.actual_completion_date')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <x-input-label for="progress_percentage" :value="__('Progress (%)')" />
                <x-text-input wire:model="form.progress_percentage" id="progress_percentage" class="mt-1 block w-full" type="number" min="0" max="100" required />
                <x-input-error :messages="$errors->get('form.progress_percentage')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="budget" :value="__('Budget (Optional)')" />
                <x-text-input wire:model="form.budget" id="budget" class="mt-1 block w-full" type="number" step="0.01" min="0" />
                <x-input-error :messages="$errors->get('form.budget')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="actual_cost" :value="__('Actual Cost (Optional)')" />
                <x-text-input wire:model="form.actual_cost" id="actual_cost" class="mt-1 block w-full" type="number" step="0.01" min="0" />
                <x-input-error :messages="$errors->get('form.actual_cost')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="location" :value="__('Location (Optional)')" />
            <x-text-input wire:model="form.location" id="location" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.location')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="assigned_team_id" :value="__('Assigned Team (Optional)')" />
                <select wire:model="form.assigned_team_id" id="assigned_team_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">None</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.assigned_team_id')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="notes" :value="__('Notes (Optional)')" />
            <textarea wire:model="form.notes" id="notes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="3"></textarea>
            <x-input-error :messages="$errors->get('form.notes')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
            <x-primary-button type="submit">Save</x-primary-button>
        </div>
    </form>
</div>
