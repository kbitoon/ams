<?php

namespace App\Livewire\Forms;

use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class RoleForm extends Form
{
    public string $name = '';
    public string $color = '';
    public ?Role $role = null;

    public function setRole(?Role $role = null): void
    {
        $this->role = $role;
        if ($role) {
            $this->name = $role->name;
            $this->color = $role->color ?? '';
        }
    }

    /**
     * @return string[][] 
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:roles,name,' . ($this->role?->id ?? '')],
            'color' => ['nullable', 'string'],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        if (!$this->role) {
            $role = Role::create($this->only(['name', 'color']));
        } else {
            $this->role->update($this->only(['name', 'color']));
            $role = $this->role;
        }

        $this->reset();
    }
}

