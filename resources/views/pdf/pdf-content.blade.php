
<div class="min-w-full align-middle">
     @if($pdfContents->count() === 0)
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.pdf-content-modal' })" class="mb-4">
            Add PDF Content
        </x-primary-button>

    @endif


    <div class="overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Header</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Footer</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Watermark</span>
                    </th>
                    
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Barangay Captain</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Expiration Days</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50"></th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                @forelse($pdfContents as $pdfContent)
                    <tr>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            @if($pdfContent->header)
                                <img src="{{ asset('storage/' . $pdfContent->header) }}" alt="Header" class="h-8">
                            @endif
                        </td>
                         <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            @if($pdfContent->footer)
                                <img src="{{ asset('storage/' . $pdfContent->footer) }}" alt="Footer" class="h-8">
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            @if($pdfContent->watermark)
                                <img src="{{ asset('storage/' . $pdfContent->watermark) }}" alt="Watermark" class="h-8">
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $pdfContent->captain }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $pdfContent->clearance_expiration_days ?? 30 }} days
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 flex space-x-2">
                            <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.pdf-content-modal', arguments: { pdfContent: {{ $pdfContent->id }} }})">
                                <i class="fas fa-pencil-alt"></i>
                            </x-secondary-button>
                            <x-danger-button x-data @click="if (confirm('Are you sure you want to delete this?')) { $wire.call('delete', {{ $pdfContent->id }}) }">
                                <i class="fas fa-trash-alt"></i>
                            </x-danger-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No PDF content added.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $pdfContents->links() }}
    </div>
</div>