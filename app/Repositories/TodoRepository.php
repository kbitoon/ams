<?php

namespace App\Repositories;
use App\Models\Todo;

class TodoRepository
{
    public function save($data)
    {
        // Handle assignment to a user or role
        $userId = $data['assigned_user_id'] ?? null; 
        $roleId = $data['role_id'] ?? null;           
        
        // Create the todo with the user or role assigned
        $createTodo = auth()->user()->todos()->create([
            'todo' => $data['todo'],
            'assigned_user_id' => $userId,
            'role_id' => $roleId,
            'is_completed' => false,
        ]);

        return $createTodo;
    }

    public function getTodo($todoId)
    {
        if (auth()->user()->hasRole('superadmin')) {
            // Superadmin can access all todos
            return Todo::find($todoId);
        }

        // Fetch task visible to the user or their role(s)
        return Todo::where(function ($query) {
            $userId = auth()->id();
            $roleId = auth()->user()->roles->pluck('id');

            $query->where('assigned_user_id', $userId)
                ->orWhereIn('role_id', $roleId)
                ->orWhereNull('assigned_user_id')
                ->orWhereNull('role_id');
        })->find($todoId);
    }


    public function fetchAll()
    {
        // Check if the user has the 'superadmin' role
        if (auth()->user()->hasRole('superadmin')) {
            return Todo::latest()->paginate(10); // Fetch all tasks for superadmin
        }

        // Regular user query
        return Todo::where(function ($query) {
            $userId = auth()->id();
            $roleIds = auth()->user()->roles->pluck('id'); // Fetch all roles of the user

            // Tasks explicitly assigned to the current user
            $query->where('assigned_user_id', $userId)
                // Tasks assigned to any of the current user's roles
                ->orWhereIn('role_id', $roleIds);
        })
        ->latest()
        ->paginate(10);
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
