<div class="container mx-auto p-5">
    <!-- Error Message -->
    <div class="flex justify-center mb-4">
        <x-input-error :messages="$errors->get('todo')" class="mt-2" />
    </div>

     <!-- Todo Form -->
     <form class="flex flex-col space-y-4" method="POST" wire:submit.prevent='addTodo'>
        <x-text-input wire:model="todo" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500" placeholder="Enter your task..." />
    
      @hasanyrole('superadmin')  
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Assign to User -->
            <select wire:model="assigned_user_id" id="assignedUser"  class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Assign to User (Optional)</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            
            <!-- Assign to Role -->
            <select wire:model="role_id" id="assignedRole" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Assign to Role (Optional)</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        @endhasanyrole

        <x-primary-button class="px-6 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex justify-center items-center">
            Add
        </x-primary-button>
    </form>

    <!-- Todo List -->
    <div class="mt-8">
    @forelse($todos as $todo)
        <div class="flex items-center justify-between p-4 mt-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-all" wire:key="todo-{{ $todo->id }}">
            <!-- Checkbox -->
            <div>
                <input type="checkbox" 
                    wire:click="markCompleted({{ $todo->id }})" 
                    @if($todo->is_completed) checked @endif 
                    class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Todo Text or Edit Field -->
            <div class="flex-1 ml-4">
                @if ($edit == $todo->id)
                    <x-text-input wire:model="editedTodo" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" />
                @else
                    <span @if($todo->is_completed) class="line-through text-green-600" @endif class="text-lg font-medium text-gray-800">
                        {{ $todo->todo }}
                    </span>
                @endif
            </div>

            <!-- Assigned User or Role Display -->
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">
                    Assigned to: 
                    @if($todo->assignedUser && $todo->role)
                        {{ $todo->assignedUser->name }} & {{ ucfirst($todo->role->name) }} role 
                    @elseif($todo->assignedUser)
                        {{ $todo->assignedUser->name }}
                    @elseif($todo->role)
                        {{ ucfirst($todo->role->name) }}
                    @else
                        Not Assigned
                    @endif
                </span>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-2">
                @if($edit == $todo->id)
                    <button wire:click='updateTodo({{ $todo->id }})' class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 ml-3">
                        <i class="fas fa-check mr-1"></i>
                    </button>
                    <button wire:click='cancelEdit' class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-3">
                        <i class="fas fa-times mr-1"></i>
                    </button>
                @else
                    <button wire:click='editTodo({{ $todo->id }})' class="p-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 ml-3">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button wire:click='deleteTodo({{ $todo->id }})' class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-3">
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
