<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>

    <form wire:submit.prevent="save">
        <!-- Mayor selection -->
        <div class="mt-4">
            <x-input-label for="mayor" :value="__('Select Mayor')" />
            @foreach ($candidates as $candidate)
                @if ($candidate->position === 'Mayor')
                    <div class="flex items-center mt-2">
                        <input type="radio" wire:model="form.mayor_id" value="{{ $candidate->id }}" id="Mayor_{{ $candidate->id }}" class="mr-2">
                        <label for="Mayor_{{ $candidate->id }}" class="text-gray-700">{{ $candidate->name }}</label>
                    </div>
                @endif
            @endforeach
            <x-input-error :messages="$errors->get('form.mayor_id')" class="mt-2" />
        </div>

        <!-- Vice Mayor selection -->
        <div class="mt-4">
            <x-input-label for="vice_mayor" :value="__('Select Vice Mayor')" />
            @foreach ($candidates as $candidate)
                @if ($candidate->position === 'Vice Mayor')
                    <div class="flex items-center mt-2">
                        <input type="radio" wire:model="form.viceMayor_id" value="{{ $candidate->id }}" id="ViceMayor_{{ $candidate->id }}" class="mr-2">
                        <label for="ViceMayor_{{ $candidate->id }}" class="text-gray-700">{{ $candidate->name }}</label>
                    </div>
                @endif
            @endforeach
            <x-input-error :messages="$errors->get('form.viceMayor_id')" class="mt-2" />
        </div>

        <!-- Congress selection -->
        <div class="mt-4">
            <x-input-label for="congress" :value="__('Select Congress')" />
            @foreach ($candidates as $candidate)
                @if ($candidate->position === 'Congress')
                    <div class="flex items-center mt-2">
                        <input type="radio" wire:model="form.congress_id" value="{{ $candidate->id }}" id="Congress_{{ $candidate->id }}" class="mr-2">
                        <label for="Congress_{{ $candidate->id }}" class="text-gray-700">{{ $candidate->name }}</label>
                    </div>
                @endif
            @endforeach
            <x-input-error :messages="$errors->get('form.congress_id')" class="mt-2" />
        </div>

        <!-- Councilor selection -->
        <div class="mt-4">
            <x-input-label for="councilors" :value="__('Select up to 8 Councilors')" />
            @foreach ($candidates as $candidate)
                @if ($candidate->position === 'Councilor')
                    <div class="flex items-center mt-2">
                        <input type="checkbox" wire:model="form.selectedCouncilors" value="{{ $candidate->id }}" id="Councilor_{{ $candidate->id }}" class="mr-2">
                        <label for="Councilor_{{ $candidate->id }}" class="text-gray-700">{{ $candidate->name }}</label>
                    </div>
                @endif
            @endforeach
            <x-input-error :messages="$errors->get('selectedCouncilors')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Submit
            </x-primary-button>
        </div>
    </form>
</div>
