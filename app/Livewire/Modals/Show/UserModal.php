<?php

namespace App\Livewire\Modals\Show;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class UserModal extends ModalComponent
{
    public ?User $user = null;

    /**
     * @param User|null $user
     */
    public function mount(User $user = null): void
    {
        if ($user && $user->exists) {
            // Load relationships if not already loaded
            if (!$user->relationLoaded('personalInformation')) {
                $user->load('personalInformation');
            }
            if (!$user->relationLoaded('roles')) {
                $user->load('roles');
            }
            $this->user = $user;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.user-management.view', [
            'user' => $this->user,
        ]);
    }
}

