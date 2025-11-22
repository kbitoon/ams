<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <form wire:submit="save">
        <!-- Name input -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model="form.title" id="title" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="category_id" :value="__('Category')" />
            <select wire:model="form.category_id" id="category_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select a category</option>
                @forelse($announcementCategories as $announcementCategory)
                    <option value="{{ $announcementCategory->id }}">{{ $announcementCategory->name }}</option>
                @empty
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.category_id')" class="mt-2" />
        </div>

        <!-- Image Upload Section -->
        <div class="mt-4">
            <x-input-label for="image" :value="__('Image (Optional)')" />
            <div class="mt-1">
                @if($form->image)
                    <div class="mb-2">
                        <img src="{{ $form->image->temporaryUrl() }}" alt="Preview" class="max-w-full h-48 object-cover rounded-lg border border-gray-300">
                    </div>
                    <button type="button" wire:click="$set('form.image', null)" class="text-sm text-red-600 hover:text-red-800">
                        Remove Image
                    </button>
                @elseif($form->existing_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $form->existing_image) }}" alt="Current Image" class="max-w-full h-48 object-cover rounded-lg border border-gray-300">
                    </div>
                    <button type="button" wire:click="form.removeImage" class="text-sm text-red-600 hover:text-red-800">
                        Remove Image
                    </button>
                @endif
                <input 
                    type="file" 
                    wire:model="form.image" 
                    id="image" 
                    accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                />
            </div>
            <x-input-error :messages="$errors->get('form.image')" class="mt-2" />
        </div>

        <!-- Image Position Selection -->
        @if($form->image || $form->existing_image)
        <div class="mt-4">
            <x-input-label for="image_position" :value="__('Image Position')" />
            <select wire:model="form.image_position" id="image_position" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="before">Before Content</option>
                <option value="after">After Content</option>
            </select>
            <x-input-error :messages="$errors->get('form.image_position')" class="mt-2" />
        </div>
        @endif

        <div class="mt-4" wire:ignore>
            <x-input-label for="content" :value="__('Content')" />
{{--            <textarea wire:model="form.content" id="content" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>--}}
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



