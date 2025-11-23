<div class="p-6 max-h-[90vh] overflow-y-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $team ? 'Edit Response Team' : 'New Response Team' }}
    </h2>

    <form wire:submit="save">
        <div class="mt-4">
            <x-input-label for="name" :value="__('Team Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" required />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description (Optional)')" />
            <textarea wire:model="form.description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="3"></textarea>
            <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="team_leader_id" :value="__('Team Leader (Optional)')" />
            <div class="relative">
                <input
                    type="text"
                    id="team_leader_id"
                    wire:model.live.debounce.300ms="leaderSearch"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Search team leader..."
                    autocomplete="off"
                />
                
                @if($form->team_leader_id)
                    @php
                        $selectedLeader = \App\Models\User::find($form->team_leader_id);
                    @endphp
                    @if($selectedLeader)
                        <div class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                            Selected: <span class="font-medium">{{ $selectedLeader->name }}</span>
                        </div>
                    @endif
                @endif

                @if($leaderSearch && $filteredLeaders->count() > 0 && !$form->team_leader_id)
                    <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700 max-h-60 overflow-auto">
                        <ul class="py-1">
                            @foreach($filteredLeaders as $user)
                                <li>
                                    <button
                                        type="button"
                                        wire:click="selectLeader({{ $user->id }})"
                                        class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"
                                    >
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <x-input-error :messages="$errors->get('form.team_leader_id')" class="mt-2" />
        </div>

        <!-- Team Members -->
        <div class="mt-4">
            <x-input-label :value="__('Team Members')" />
            <div class="space-y-3 mt-2">
                @foreach($form->members as $index => $member)
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label :value="__('Member')" />
                                <div class="relative">
                                    <input
                                        type="text"
                                        wire:model.live.debounce.300ms="memberSearches.{{ $index }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        placeholder="Search member..."
                                        autocomplete="off"
                                    />
                                    
                                    @if($member['user_id'] && isset($memberSearches[$index]))
                                        @php
                                            $memberUser = \App\Models\User::find($member['user_id']);
                                        @endphp
                                        @if($memberUser && $memberSearches[$index] === $memberUser->name)
                                            <div class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                                                Selected: <span class="font-medium">{{ $memberUser->name }}</span>
                                            </div>
                                        @endif
                                    @endif

                                    @if(isset($memberSearches[$index]) && $memberSearches[$index] && isset($filteredMembers[$index]) && $filteredMembers[$index]->count() > 0 && !$member['user_id'])
                                        <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700 max-h-60 overflow-auto">
                                            <ul class="py-1">
                                                @foreach($filteredMembers[$index] as $user)
                                                    <li>
                                                        <button
                                                            type="button"
                                                            wire:click="selectMember({{ $user->id }}, {{ $index }})"
                                                            class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"
                                                        >
                                                            <div class="font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <x-input-label :value="__('Role')" />
                                <select wire:model="form.members.{{ $index }}.role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="member">Member</option>
                                    <option value="deputy_leader">Deputy Leader</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <div>
                                <x-input-label :value="__('Specialization (Optional)')" />
                                <x-text-input wire:model="form.members.{{ $index }}.specialization" class="mt-1 block w-full" type="text" />
                            </div>

                            <div>
                                <x-input-label :value="__('Contact Number (Optional)')" />
                                <x-text-input wire:model="form.members.{{ $index }}.contact_number" class="mt-1 block w-full" type="text" />
                            </div>
                        </div>

                        <div class="mt-2 flex items-center justify-between">
                            <label class="inline-flex items-center">
                                <input type="checkbox" wire:model="form.members.{{ $index }}.is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Active</span>
                            </label>
                            <button type="button" wire:click="removeMember({{ $index }})" class="text-red-600 hover:text-red-800 dark:text-red-400">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" wire:click="addMember" class="mt-3 text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400">
                <i class="fas fa-plus mr-1"></i> Add Member
            </button>
            <x-input-error :messages="$errors->get('form.members')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="form.is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Active</span>
            </label>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
            <x-primary-button type="submit">Save</x-primary-button>
        </div>
    </form>
</div>
