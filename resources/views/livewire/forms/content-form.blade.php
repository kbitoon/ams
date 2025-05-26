<div class="p-6 ">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <!-- Right Logo input -->
        <div class="mt-4">
            <x-input-label for="right_logo" :value="__('Right Logo')" />
            <input wire:model="form.right_logo" id="right_logo" class="mt-1 block w-full" type="file" accept="image/*">
            <x-input-error :messages="$errors->get('form.right_logo')" class="mt-2" />
            @if(isset($form->pdfContent) && $form->pdfContent?->right_logo)
                <img src="{{ asset('storage/' . $form->pdfContent->right_logo) }}" alt="Right Logo" class="h-12 mt-2">
            @endif
        </div>

        <!-- Left Logo input -->
        <div class="mt-4">
            <x-input-label for="left_logo" :value="__('Left Logo')" />
            <input wire:model="form.left_logo" id="left_logo" class="mt-1 block w-full" type="file" accept="image/*">
            <x-input-error :messages="$errors->get('form.left_logo')" class="mt-2" />
            @if(isset($form->pdfContent) && $form->pdfContent?->left_logo)
                <img src="{{ asset('storage/' . $form->pdfContent->left_logo) }}" alt="Left Logo" class="h-12 mt-2">
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