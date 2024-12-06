<?php

namespace App\Livewire;

use App\Repositories\TodoRepository;
use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;


class Todo extends Component
{
    use WithPagination;

    protected $repository;
    protected $listeners = ['todosUpdated' => '$refresh'];

    #[Validate('required|min:3')]

    public $todo = '';

    #[Validate('required|min:3')]
    public $editedTodo;

    public $edit;
    public $users;
    public $roles;
    public $assigned_user_id;
    public $role_id;

    public function boot(TodoRepository $respository)
    {
        $this->repository = $respository;
    }

    public function addTodo()
    {
        $validated = $this->validateOnly('todo');
        
        $validated['assigned_user_id'] = $this->assigned_user_id;
        $validated['role_id'] = $this->role_id;

        $this->repository->save($validated);
        
        $this->todo = '';
        $this->assigned_user_id = null;
        $this->role_id = null; 
    }

    public function editTodo($todoId)
    {
        $this->edit = $todoId;
        $this->editedTodo = $this->repository->getTodo($todoId)->todo;
    }

    public function updateTodo($todoId)
    {
        $validated = $this->validateOnly('editedTodo');
        $this->repository->update($todoId, $validated['editedTodo']);
        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->edit = '';
    }

    public function deleteTodo($todoId)
    {
        $this->repository->delete($todoId);
    }

    public function markCompleted($todoId)
    {
        return $this->repository->completed($todoId);
        $this->emit('todosUpdated');
    }

    public function render()
    {
        $this->users = User::all();
        $this->roles = Role::all();
        
        $todos = $this->repository->fetchAll();
        return view('livewire.todo.list', compact('todos'));
    }
}
