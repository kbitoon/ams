<div class="p-6 z-30">
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
                @forelse($informationCategories as $informationCategory)
                    <option value="{{ $informationCategory->id }}">{{ $informationCategory->name }}</option>
                @empty
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.category_id')" class="mt-2" />
        </div>

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

        <div class="mt-4">
            <x-input-label for="public" :value="__('Public')" />
            <select wire:model="form.public" id="public" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
            </select>
            <x-input-error :messages="$errors->get('form.public')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>



