<?php

namespace App\Livewire\Forms;

use App\Models\Todo;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class TodoForm extends Form
{
    public ?Todo $todo = null;

    public ?string $role_id = null;
    public ?string $assigned_user_id = null;
    public string $task = '';
    public ?string $due_date = null;

    /**
     * @param Todo|null $todo
     */
    public function setTodo(?Todo $todo = null): void
    {
        $this->todo = $todo;
        $this->role_id = $todo->role_id ?? null;
        $this->assigned_user_id = $todo->assigned_user_id ?? null;
        $this->task = $todo->task ?? '';
        $this->due_date = $todo->due_date ?? null;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'role_id' => ['nullable'],
            'assigned_user_id' => ['nullable'],
            'task' => ['required'],
            'due_date' => ['nullable','after_or_equal:today'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'role_id' => 'Role',
            'assigned_user_id' => 'Assigned User',
            'task' => 'Task',
            'due_date' => 'Due Date',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

       
        $data = $this->only(['role_id', 'assigned_user_id', 'task', 'due_date']);
        $data['role_id'] = $data['role_id'] === '' ? null : $data['role_id'];
        $data['assigned_user_id'] = $data['assigned_user_id'] === '' ? null : $data['assigned_user_id'];

        if (!$this->todo) {
            if (auth()->user()) {
                $this->todo = auth()->user()->todos()->create($data);
            }
        } else {
            $this->todo->update($data);
        }

        $this->reset();
    }
}
