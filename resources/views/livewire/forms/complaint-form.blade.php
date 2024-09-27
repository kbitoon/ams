<div class="p-6 ">
    <form wire:submit="save">
        <!-- Name input -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="date" :value="__('Contact Number')" />
            <x-text-input wire:model="form.contact_number" id="contact_number" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.contact_number')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model="form.title" id="title" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="category_id" :value="__('Category')" />
            <select wire:model="form.category_id" id="category_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select a category</option>
                @forelse($complaintCategories as $complaintCategory)
                    <option value="{{ $complaintCategory->id }}">{{ $complaintCategory->name }}</option>
                @empty
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.category_id')" class="mt-2" />
        </div>

        <div class="mt-4" wire:ignore>
            <x-input-label for="content" :value="__('Content')" />
            <trix-editor
                id="content"
                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                x-data
                x-on:trix-change="$dispatch('input', event.target.value)"
                x-ref="trix"
                wire:model.debounce.60s="form.content"
                wire:key="contentKey"
            ></trix-editor>
            <x-input-error :messages="$errors->get('form.content')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>



