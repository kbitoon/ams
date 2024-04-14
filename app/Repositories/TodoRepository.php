<?php

namespace App\Repositories;

class TodoRepository
{
    public function save($data)
    {
        $createTodo = auth()->user()->todos()->create($data);
        if ($createTodo) {
            return $createTodo;
        }
    }

    public function getTodo($todoId)
    {
        return auth()->user()->todos()->find($todoId);
    }

    public function fetchAll()
    {
        return auth()->user()->todos()->latest()->paginate(10);
    }

    public function update($todoId, $editedTodo)
    {
        $todo = $this->getTodo($todoId);
        return $todo->update([
            'todo' => $editedTodo
        ]);
    }

    public function completed($todoId)
    {
        $todo = $this->getTodo($todoId);
        return ($todo->is_completed) ? $todo->update(['is_completed' => false]) : $todo->update(['is_completed' => true]);
    }

    public function delete($todoId)
    {
        $this->getTodo($todoId)->delete();
    }
}
