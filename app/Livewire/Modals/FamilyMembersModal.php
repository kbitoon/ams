<?php

namespace App\Livewire\Modals;

use App\Models\Family;
use LivewireUI\Modal\ModalComponent;

class FamilyMembersModal extends ModalComponent
{
    public ?Family $family = null;

    public function mount(Family $family = null): void
    {
        if ($family && $family->exists) {
            $this->family = $family->load([
                'headOfFamily.personalInformation',
                'members.user.personalInformation'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.modals.family-members-modal');
    }
}

