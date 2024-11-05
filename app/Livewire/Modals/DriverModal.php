<?php

namespace App\Livewire\Modals;

use App\Models\Driver;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\DriverForm;

class DriverModal extends ModalComponent
{
    public ?Driver $driver = null;
    public DriverForm $form;
    
    /**
     * @param Driver|null $driver
     */
    public function mount(Driver $driver = null): void
    {
        if ($driver && $driver->exists) {
            $this->form->setDriver($driver);
        }

    }

    /**
     * Save driver
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
        return view('livewire.forms.driver-form', [
            'drivers' => Driver::all(),
        ]);
    }
}
