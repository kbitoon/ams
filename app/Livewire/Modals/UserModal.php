<?php

namespace App\Livewire\Modals;

use App\Models\User;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\UserForm;

class UserModal extends ModalComponent
{
    public ?User $user = null;
    public UserForm $form;
    
    /**
     * @param User|null $user
     */
    public function mount(User $user = null): void
    {
        if ($user && $user->exists) {
            $this->form->setUser($user);
        }

    }

    /**
     * Save user
     */
    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.forms.user-form', [
            'users' => User::all(), // Pass collection to the view
        ]);
    }
}
