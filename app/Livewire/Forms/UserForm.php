<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user = null;

    public string $name = '';
    public string $email = '';

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
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'email' => 'email',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        if (!$this->user) {
            User::create($this->only(['name', 'email']));
        } else {
            $this->user->update($this->only(['name', 'email']));
        }

        $this->reset();
    }
}
