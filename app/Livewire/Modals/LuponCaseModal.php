<?php

namespace App\Livewire\Modals;

use App\Models\LuponCase;
use App\Models\Blotter;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\LuponCaseForm;

class LuponCaseModal extends ModalComponent
{
    use WithFileUploads;

    public ?LuponCase $luponCase = null;
    public LuponCaseForm $form;
    public Collection $blotters;
   

    public string $resolution_form = '';

    /**
     * @param LuponCase|null $luponCase
     */
    public function mount(LuponCase $luponCase = null): void
    {
        if ($luponCase && $luponCase->exists) {
            $this->form->setLuponCase($luponCase);
        }
  
        $this->blotters = Blotter::orderBy('id')->get();
    }

    /**
     * Save luponCase
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
        return view('livewire.forms.lupon-case-form',  [
            'blotters' => $this->blotters,
            'resolution_form' => $this->resolution_form,
        ]);
    }
}
