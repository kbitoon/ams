<div class="p-6 ">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="mt-4">
            <x-input-label for="header" :value="__('Header')" />
            <input wire:model="form.header" id="header" class="mt-1 block w-full" type="file" accept="image/*">
            <x-input-error :messages="$errors->get('form.header')" class="mt-2" />
            @if(isset($form->pdfContent) && $form->pdfContent?->header)
                <img src="{{ asset('storage/' . $form->pdfContent->header) }}" alt="Header" class="h-12 mt-2">
            @endif
        </div>

        <div class="mt-4">
            <x-input-label for="captain" :value="__('Barangay Captain')" />
            <x-text-input wire:model="form.captain" id="captain" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.captain')" class="mt-2" />

        <!-- Save button -->
        <div class="mt-6">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>