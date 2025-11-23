<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $family ? 'Edit Family' : 'New Family' }}
    </h2>

    <form wire:submit="save">
        <div class="mt-4">
            <x-input-label for="head_of_family_id" :value="__('Head of Family')" />
            <div class="relative">
                <input
                    type="text"
                    id="head_of_family_id"
                    wire:model.live.debounce.300ms="headSearch"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Search resident by name or email..."
                    autocomplete="off"
                />
                
                @if($form->head_of_family_id)
                    @php
                        $selectedUser = \App\Models\User::find($form->head_of_family_id);
                    @endphp
                    @if($selectedUser)
                        <div class="mt-1 text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                            <span>Selected: <span class="font-medium">{{ $selectedUser->name }}</span></span>
                            <button 
                                type="button"
                                wire:click="$set('form.head_of_family_id', ''); $set('headSearch', '')"
                                class="text-red-600 hover:text-red-800 font-bold text-lg leading-none"
                                title="Clear selection"
                            >
                                ×
                            </button>
                        </div>
                    @endif
                @endif

                @if($headSearch && $filteredHeadUsers->count() > 0 && !$form->head_of_family_id)
                    <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700 max-h-60 overflow-auto">
                        <ul class="py-1">
                            @foreach($filteredHeadUsers as $user)
                                <li>
                                    <button
                                        type="button"
                                        wire:click="selectHead({{ $user->id }})"
                                        class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 focus:bg-gray-100 dark:focus:bg-gray-700 focus:outline-none"
                                    >
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @elseif($headSearch && $filteredHeadUsers->count() === 0)
                    <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700">
                        <div class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                            No users found
                        </div>
                    </div>
                @endif
            </div>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Search and select the head of the family</p>
            <x-input-error :messages="$errors->get('form.head_of_family_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="family_name" :value="__('Family Name (Optional)')" />
            <x-text-input wire:model="form.family_name" id="family_name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.family_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input wire:model="form.address" id="address" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.address')" class="mt-2" />
        </div>

        <!-- Family Members -->
        <div class="mt-4">
            <x-input-label for="members" :value="__('Family Members')" />
            <div class="space-y-2">
                @foreach($form->members as $index => $memberId)
                    @php
                        $memberSearch = $memberSearches[$index] ?? '';
                        $memberUsers = $filteredMemberUsers[$index] ?? collect([]);
                        $member = \App\Models\User::find($memberId);
                    @endphp
                    <div class="flex items-center gap-2">
                        <div class="flex-1 relative">
                            <input
                                type="text"
                                wire:model.live.debounce.300ms="memberSearches.{{ $index }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="{{ $member ? 'Search to change member...' : 'Search member...' }}"
                                autocomplete="off"
                            />
                            
                            @if($member)
                                <div class="mt-1 text-xs text-gray-600 dark:text-gray-400 flex items-center gap-2">
                                    <span>Selected: <span class="font-medium">{{ $member->name }}</span></span>
                                </div>
                            @endif

                            @if($memberSearch && $memberUsers->count() > 0 && !$memberId)
                                <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700 max-h-60 overflow-auto">
                                    <ul class="py-1">
                                        @foreach($memberUsers as $user)
                                            <li>
                                                <button
                                                    type="button"
                                                    wire:click="selectMember({{ $user->id }}, {{ $index }})"
                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 focus:bg-gray-100 dark:focus:bg-gray-700 focus:outline-none"
                                                >
                                                    <div class="font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @elseif($memberSearch && $memberUsers->count() === 0 && !$memberId && $memberSearch !== ($member ? $member->name : ''))
                                <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700">
                                    <div class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                                        No users found
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button 
                            type="button" 
                            wire:click="removeMember({{ $index }})" 
                            class="text-red-600 hover:text-red-800 dark:text-red-400"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endforeach
            </div>
            <button 
                type="button" 
                wire:click="addMemberField" 
                class="mt-2 text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400"
            >
                <i class="fas fa-plus mr-1"></i> Add Member
            </button>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Add other family members (head will be automatically included)</p>
            <x-input-error :messages="$errors->get('form.members')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
            <x-primary-button type="submit">Save</x-primary-button>
        </div>
    </form>
</div>

