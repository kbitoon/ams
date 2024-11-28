<?php

namespace App\Livewire\Modals;

use Spatie\Permission\Models\Role;
use App\Livewire\Forms\RoleForm;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class RoleModal extends ModalComponent
{
    public ?Role $role = null;
    public RoleForm $form;

    /**
     * Mount the component and set the role if editing.
     *
     * @param Role|null $role
     */
    public function mount(Role $role = null): void
    {

        if ($role && $role->exists) {
            $this->form->setRole($role); // Set the role if editing
        }
    }

    /**
     * Save the role and close the modal.
     */
    public function save(): void
    {
        $this->form->save(); // Save the role using RoleForm
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    /**
     * Render the modal view.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.forms.role-form');
    }
}
