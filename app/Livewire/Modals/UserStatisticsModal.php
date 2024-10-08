<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\UserStatisticsForm;
use App\Models\UserStatistics;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class UserStatisticsModal extends ModalComponent
{
    public ?UserStatistics $userStatistics = null;
    public UserStatisticsForm $form;

    /**
     * @param UserStatistics|null $userStatistics
     */
    public function mount(UserStatistics $userStatistics = null): void
    {
        if ($userStatistics && $userStatistics->exists) {
            $this->form->setUserStatistics($userStatistics);
        }
    }

    /**
     * Save clearance
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
    public function render(): View{
        return view('livewire.forms.user-statistics-form');
    }
    
}
