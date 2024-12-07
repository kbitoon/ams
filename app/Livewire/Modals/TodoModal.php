<?php

namespace App\Livewire\Modals;

use App\Models\Todo;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\TodoForm;
use Illuminate\Database\Eloquent\Collection;


class TodoModal extends ModalComponent
{
    public ?Todo $todo = null;
    public TodoForm $form;
    public Collection $roles, $users;
    
    /**
     * @param Todo|null $todo
     */
    public function mount(Todo $todo = null): void
    {
        
        if ($todo && $todo->exists) {
            $this->form->setTodo($todo);
        }

        $this->roles = Role::all();
        $this->users = User::all();

    }

    /**
     * Save item
     */
    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refreshTodoList');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.forms.todo-form', [
            'roles' => $this->roles,
            'users' => $this->users,
        ]);
    }
}
