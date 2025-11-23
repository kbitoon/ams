<div class="p-6 max-h-[90vh] overflow-y-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $reliefDistribution ? 'Edit Distribution' : 'Record Distribution' }}
    </h2>

    <form wire:submit="save">
        <div class="mt-4">
            <x-input-label for="relief_operation_id" :value="__('Relief Operation')" />
            <select wire:model.live="form.relief_operation_id" id="relief_operation_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Select Operation</option>
                @foreach($operations as $operation)
                    <option value="{{ $operation->id }}">{{ $operation->title }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('form.relief_operation_id')" class="mt-2" />
        </div>

        @if($selectedOperation)
            <div class="mt-4">
                <x-input-label for="relief_item_id" :value="__('Relief Item')" />
                <select wire:model="form.relief_item_id" id="relief_item_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Select Item</option>
                    @foreach($selectedOperation->reliefItems as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->reliefType->name }} 
                            (Available: {{ number_format($item->quantity_remaining, 2) }} {{ $item->reliefType->unit }})
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.relief_item_id')" class="mt-2" />
            </div>
        @endif

        <div class="mt-4">
            <x-input-label for="distribution_type" :value="__('Distribution Type')" />
            <select wire:model.live="form.distribution_type" id="distribution_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="individual">Individual</option>
                <option value="family">Per Family</option>
            </select>
            <x-input-error :messages="$errors->get('form.distribution_type')" class="mt-2" />
        </div>

        @if($form->distribution_type === 'family')
            <div class="mt-4">
                <x-input-label for="family_id" :value="__('Family')" />
                <select wire:model.live="form.family_id" id="family_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Select Family</option>
                    @foreach($families as $family)
                        <option value="{{ $family->id }}">
                            {{ $family->headOfFamily->name }} 
                            @if($family->family_name) - {{ $family->family_name }} @endif
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.family_id')" class="mt-2" />
            </div>

            @if($form->family_id)
                @php
                    $selectedFamily = $families->firstWhere('id', $form->family_id);
                @endphp
                @if($selectedFamily)
                    <div class="mt-2 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            <strong>Head of Family:</strong> {{ $selectedFamily->headOfFamily->name }}
                        </p>
                    </div>
                @endif
            @endif

            <div class="mt-4">
                <x-input-label for="user_id" :value="__('Representative (Who Received)')" />
                <div class="relative">
                    <input
                        type="text"
                        id="user_id"
                        wire:model.live.debounce.300ms="userSearch"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Search family member by name or email..."
                        autocomplete="off"
                    />
                    
                    @if($form->user_id)
                        @php
                            $selectedUser = \App\Models\User::find($form->user_id);
                        @endphp
                        @if($selectedUser)
                            <div class="mt-1 text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                                <span>Selected: <span class="font-medium">{{ $selectedUser->name }}</span></span>
                                <button 
                                    type="button"
                                    wire:click="$set('form.user_id', ''); $set('userSearch', '')"
                                    class="text-red-600 hover:text-red-800 font-bold text-lg leading-none"
                                    title="Clear selection"
                                >
                                    ×
                                </button>
                            </div>
                        @endif
                    @endif

                    @if($userSearch && $filteredUsers->count() > 0 && !$form->user_id)
                        <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700 max-h-60 overflow-auto">
                            <ul class="py-1">
                                @foreach($filteredUsers as $user)
                                    <li>
                                        <button
                                            type="button"
                                            wire:click="selectUser({{ $user->id }})"
                                            class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 focus:bg-gray-100 dark:focus:bg-gray-700 focus:outline-none"
                                        >
                                            <div class="font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif($userSearch && $filteredUsers->count() === 0)
                        <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700">
                            <div class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                                No users found
                            </div>
                        </div>
                    @endif
                </div>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Select the family member who actually received the relief goods</p>
                <x-input-error :messages="$errors->get('form.user_id')" class="mt-2" />
            </div>
        @else
            <div class="mt-4">
                <x-input-label for="user_id" :value="__('Recipient')" />
                <div class="relative">
                    <input
                        type="text"
                        id="user_id"
                        wire:model.live.debounce.300ms="userSearch"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Search resident by name or email..."
                        autocomplete="off"
                    />
                    
                    @if($form->user_id)
                        @php
                            $selectedUser = \App\Models\User::find($form->user_id);
                        @endphp
                        @if($selectedUser)
                            <div class="mt-1 text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                                <span>Selected: <span class="font-medium">{{ $selectedUser->name }}</span></span>
                                <button 
                                    type="button"
                                    wire:click="$set('form.user_id', ''); $set('userSearch', '')"
                                    class="text-red-600 hover:text-red-800 font-bold text-lg leading-none"
                                    title="Clear selection"
                                >
                                    ×
                                </button>
                            </div>
                        @endif
                    @endif

                    @if($userSearch && $filteredUsers->count() > 0 && !$form->user_id)
                        <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700 max-h-60 overflow-auto">
                            <ul class="py-1">
                                @foreach($filteredUsers as $user)
                                    <li>
                                        <button
                                            type="button"
                                            wire:click="selectUser({{ $user->id }})"
                                            class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 focus:bg-gray-100 dark:focus:bg-gray-700 focus:outline-none"
                                        >
                                            <div class="font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif($userSearch && $filteredUsers->count() === 0)
                        <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700">
                            <div class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                                No users found
                            </div>
                        </div>
                    @endif
                </div>
                <x-input-error :messages="$errors->get('form.user_id')" class="mt-2" />
            </div>
        @endif

        <div class="mt-4">
            <x-input-label for="quantity" :value="__('Quantity')" />
            <x-text-input wire:model="form.quantity" id="quantity" class="mt-1 block w-full" type="number" step="0.01" />
            <x-input-error :messages="$errors->get('form.quantity')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="amount" :value="__('Amount (if applicable)')" />
            <x-text-input wire:model="form.amount" id="amount" class="mt-1 block w-full" type="number" step="0.01" />
            <x-input-error :messages="$errors->get('form.amount')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="purpose" :value="__('Purpose/Reason')" />
            <x-text-input wire:model="form.purpose" id="purpose" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.purpose')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="distributed_at" :value="__('Distribution Date & Time')" />
            <input type="datetime-local" wire:model="form.distributed_at" id="distributed_at" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <x-input-error :messages="$errors->get('form.distributed_at')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
            <x-primary-button type="submit">Save Distribution</x-primary-button>
        </div>
    </form>
</div>

