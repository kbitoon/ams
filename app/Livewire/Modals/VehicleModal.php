<?php

namespace App\Livewire\Modals;

use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\VehicleForm;

class VehicleModal extends ModalComponent
{
    public ?Vehicle $vehicle = null;
    public VehicleForm $form;
    
    /**
     * @param Vehicle|null $vehicle
     */
    public function mount(Vehicle $vehicle = null): void
    {
        if ($vehicle && $vehicle->exists) {
            $this->form->setVehicle($vehicle);
        }

    }

    /**
     * Save vehicle
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
        return view('livewire.forms.vehicle-form', [
            'vehicles' => Vehicle::all(), // Pass collection to the view
        ]);
    }
}
