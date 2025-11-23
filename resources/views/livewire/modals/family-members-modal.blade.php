<div class="p-6 max-h-[90vh] overflow-y-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    @if($family)
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
            Family Members: {{ $family->family_name ?? 'Unnamed Family' }}
        </h2>
        
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            <p><strong>Head of Family:</strong> {{ $family->headOfFamily->name }}</p>
            @if($family->address)
                <p class="mt-1"><strong>Address:</strong> {{ $family->address }}</p>
            @endif
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Phone Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Head of Family -->
                    <tr class="bg-blue-50 dark:bg-blue-900/20">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $family->headOfFamily->name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $family->headOfFamily->personalInformation->contact_number ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                Head of Family
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <button 
                                wire:click="$dispatch('openModal', { component: 'modals.show.user-modal', arguments: { user: {{ $family->headOfFamily->id }} }})"
                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                title="View Profile"
                            >
                                <i class="fas fa-eye"></i> View
                            </button>
                        </td>
                    </tr>
                    
                    <!-- Other Members -->
                    @foreach($family->members as $member)
                        @if($member->user && !$member->is_head)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $member->user->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $member->user->personalInformation->contact_number ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                        {{ $member->relationship ?? 'Member' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <button 
                                        wire:click="$dispatch('openModal', { component: 'modals.show.user-modal', arguments: { user: {{ $member->user->id }} }})"
                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                        title="View Profile"
                                    >
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            
            @if($family->members->where('is_head', false)->count() === 0)
                <div class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                    No additional members in this family.
                </div>
            @endif
        </div>
    @endif
</div>

