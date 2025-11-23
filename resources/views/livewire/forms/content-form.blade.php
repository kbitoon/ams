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
            <x-input-label for="footer" :value="__('Footer')" />
            <input wire:model="form.footer" id="footer" class="mt-1 block w-full" type="file" accept="image/*">
            <x-input-error :messages="$errors->get('form.footer')" class="mt-2" />
            @if(isset($form->pdfContent) && $form->pdfContent?->footer)
                <img src="{{ asset('storage/' . $form->pdfContent->footer) }}" alt="Footer" class="h-12 mt-2">
            @endif
        </div>
        <div class="mt-4">
            <x-input-label for="watermark" :value="__('Watermark')" />
            <input wire:model="form.watermark" id="watermark" class="mt-1 block w-full" type="file" accept="image/*">
            <x-input-error :messages="$errors->get('form.watermark')" class="mt-2" />
            @if(isset($form->pdfContent) && $form->pdfContent?->watermark)
                <img src="{{ asset('storage/' . $form->pdfContent->watermark) }}" alt="Watermark" class="h-12 mt-2">
            @endif
        </div>

        <div class="mt-4">
            <x-input-label for="captain" :value="__('Barangay Captain')" />
            <x-text-input wire:model="form.captain" id="captain" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.captain')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="clearance_expiration_days" :value="__('Clearance Expiration Days')" />
            <x-text-input wire:model="form.clearance_expiration_days" id="clearance_expiration_days" class="mt-1 block w-full" type="number" min="1" max="365" />
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Number of days before a clearance expires (default: 30 days)</p>
            <x-input-error :messages="$errors->get('form.clearance_expiration_days')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-6">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>