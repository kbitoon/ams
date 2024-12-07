<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <form wire:submit.prevent="save">

        <div class="mt-4">
            <x-input-label for="task" :value="__('Task')" />
            <x-text-input wire:model="form.task" id="task" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.task')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="role_id" :value="__('Assign Role')" />
            <select wire:model="form.role_id" id="role_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select an assigned role (optional)</option>
                @forelse($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @empty
                   <option>No Role available</option>
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.role_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="assigned_user_id" :value="__('Assign User')" />
            <select wire:model="form.assigned_user_id" id="assigned_user_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select an assigned role (optional)</option>
                @forelse($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @empty
                   <option>No User available</option>
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.assigned_user_id')" class="mt-2" />
        </div>

         <div class="mt-4">
                <x-input-label for="due_date" :value="__('Due Date')" />
                <x-input-datetime wire:model="form.due_date" id="due_date" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.due_date')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
