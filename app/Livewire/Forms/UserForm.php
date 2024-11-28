<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user = null;

    public string $name = '';
    public string $email = '';
    public ?string $roles = null;

    /**
     * Set the user data into the form.
     *
     * @param User|null $user
     */
    public function setUser(?User $user = null): void
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roles = $user->roles->first()?->name;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'roles' => ['nullable', 'exists:roles,name'],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        if (!$this->user) {
            $user = User::create($this->only(['name', 'email']));
        } else {
            $this->user->update($this->only(['name', 'email']));
            $user = $this->user;
        }

        if ($this->roles) {
            $user->syncRoles([$this->roles]);
        } else {
            $user->syncRoles([]);
        }

        $this->reset();
    }
}
