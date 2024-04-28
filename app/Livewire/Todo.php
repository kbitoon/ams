<?php

namespace App\Livewire;

use App\Repositories\TodoRepository;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;


class Todo extends Component
{
    use WithPagination;

    protected $repository;

    #[Validate('required|min:3')]

    public $todo = '';

    #[Validate('required|min:3')]
    public $editedTodo;

    public $edit;

    public function boot(TodoRepository $respository)
    {
        $this->repository = $respository;
    }

    public function addTodo()
    {
        $validated = $this->validateOnly('todo');
        $this->repository->save($validated);
        $this->todo = '';
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
    }

    public function render()
    {
        $todos = $this->repository->fetchAll();
        return view('livewire.todo.list', compact('todos'));
    }
}
