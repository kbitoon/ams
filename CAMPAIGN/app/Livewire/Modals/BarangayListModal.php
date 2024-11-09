<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\BarangayListForm;
use App\Models\BarangayList;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class BarangayListModal extends ModalComponent
{
    public ?BarangayList $barangayList = null;
    public BarangayListForm $form;

    /**
     * @param BarangayList|null $barangayList
     */
    public function mount(BarangayList $barangayList = null): void
    {
        if ($barangayList && $barangayList->exists) {
            $this->form->setBarangayList($barangayList);
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
    public function render() : View
    {
        return view('livewire.forms.barangay-list-form');
    }
}
