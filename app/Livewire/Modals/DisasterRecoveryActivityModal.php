<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\DisasterRecoveryActivityForm;
use App\Models\DisasterRecoveryActivity;
use App\Models\DisasterEvent;
use App\Models\DisasterResponseTeam;
use LivewireUI\Modal\ModalComponent;

class DisasterRecoveryActivityModal extends ModalComponent
{
    public ?DisasterRecoveryActivity $activity = null;
    public DisasterRecoveryActivityForm $form;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount(DisasterRecoveryActivity $activity = null): void
    {
        if ($activity && $activity->exists) {
            $this->activity = $activity;
            $this->form->setActivity($activity);
        }
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render()
    {
        return view('livewire.modals.disaster-recovery-activity-modal', [
            'events' => DisasterEvent::orderBy('title')->get(),
            'teams' => DisasterResponseTeam::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
