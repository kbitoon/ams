<div class="p-6 max-h-[90vh] overflow-y-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        Complete Preparedness Checklist
    </h2>

    @if($checklist)
        <div class="mb-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
            <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ $checklist->title }}</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $checklist->disasterType->name }}</p>
            @if($checklist->description)
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ $checklist->description }}</p>
            @endif
        </div>

        <form wire:submit="save">
            <div class="mb-4">
                <x-input-label for="disaster_event_id" :value="__('Related Disaster Event (Optional)')" />
                <select wire:model="form.disaster_event_id" id="disaster_event_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">None (General Preparedness)</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }} ({{ $event->start_date->format('M d, Y') }})</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.disaster_event_id')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="completed_at" :value="__('Completion Date & Time')" />
                <input type="datetime-local" wire:model="form.completed_at" id="completed_at" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                <x-input-error :messages="$errors->get('form.completed_at')" class="mt-2" />
            </div>

            <div class="mb-6">
                <x-input-label :value="__('Checklist Items')" />
                <div class="mt-2 space-y-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                    @foreach($checklist->items as $item)
                        <label class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                            <input 
                                type="checkbox" 
                                wire:click="toggleItem({{ $item->id }})"
                                @if(in_array($item->id, $form->completed_items)) checked @endif
                                class="mt-1 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $item->item }}</span>
                                    @if($item->is_required)
                                        <span class="text-xs px-2 py-0.5 rounded bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Required</span>
                                    @endif
                                </div>
                                @if($item->description)
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $item->description }}</p>
                                @endif
                            </div>
                        </label>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('form.completed_items')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="notes" :value="__('Notes (Optional)')" />
                <textarea wire:model="form.notes" id="notes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="3" placeholder="Add any additional notes..."></textarea>
                <x-input-error :messages="$errors->get('form.notes')" class="mt-2" />
            </div>

            <div class="flex justify-end gap-3">
                <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
                <x-primary-button type="submit">Complete Checklist</x-primary-button>
            </div>
        </form>
    @endif
</div>
