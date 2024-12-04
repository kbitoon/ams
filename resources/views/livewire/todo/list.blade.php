<div class="container mx-auto p-5">
    <!-- Error Message -->
    <div class="flex justify-center mb-4">
        <x-input-error :messages="$errors->get('todo')" class="mt-2" />
    </div>

    <!-- Todo Form -->
    <form class="flex items-center space-x-4" method="POST" wire:submit.prevent='addTodo'>
        <x-text-input wire:model="todo" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500" placeholder="Enter your task..." />
        <x-primary-button class="px-6 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Add
        </x-primary-button>
    </form>

    <!-- Todo List -->
    <div class="mt-8">
        @forelse($todos as $todo)
            <div class="flex items-center justify-between p-4 mt-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-all">
                <!-- Checkbox -->
                <div>
                    <input id="green-checkbox" wire:click='markCompleted({{ $todo->id }})' 
                        @if($todo->is_completed) checked @endif 
                        type="checkbox" class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-2 focus:ring-green-500">
                </div>

                <!-- Todo Text or Edit Field -->
                <div class="flex-1 ml-4">
                    @if ($edit == $todo->id)
                        <x-text-input wire:model='editedTodo' class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" />
                    @else
                        <span @if($todo->is_completed) class="line-through text-green-600" @endif class="text-lg font-medium text-gray-800">
                            {{ $todo->todo }}
                        </span>
                    @endif
                </div>

                <!-- Action Buttons (Simple Icons) -->
                <div class="flex space-x-2">
                    @if($edit == $todo->id)
                        <button wire:click='updateTodo({{ $todo->id }})' class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 ml-3">
                            <!-- Simple Checkmark Icon for Update -->
                            <i class="fas fa-check mr-1"></i>
                        </button>
                        <button wire:click='cancelEdit' class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-3">
                            <!-- Simple X Icon for Cancel -->
                            <i class="fas fa-times mr-1"></i>
                        </button>
                    @else
                        <button wire:click='editTodo({{ $todo->id }})' class="p-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 ml-3">
                            <!-- Simple Pencil Icon for Edit -->
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button wire:click='deleteTodo({{ $todo->id }})' class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-3">
                            <!-- Simple Trash Icon for Delete -->
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500">No tasks found!</div>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="mt-8 text-center">
        {{ $todos->links() }}
    </div>
</div>
