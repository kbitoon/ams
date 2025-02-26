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
    public string $search = '';
    /**
     * @param LuponCase|null $luponCase
     */
    public function mount(LuponCase $luponCase = null): void
    {
        if ($luponCase && $luponCase->exists) {
            $this->form->setLuponCase($luponCase);
        } else {
            // Generate suggested case_no if creating a new case
            $latestCase = LuponCase::latest('id')->first();
            $lastId = $latestCase ? $latestCase->id : 0;
            $suggestedCaseNo = now()->format('Y-m') . '-' . ($lastId + 1);
    
            $this->form->case_no = $suggestedCaseNo; // Pre-fill case_no
        }
    
        $this->blotters = Blotter::orderBy('id')->get();
    }

    /**
     * Get filtered blotters based on search
     */
    public function getFilteredBlottersProperty()
    {
        return Blotter::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('id', 'like', '%' . $this->search . '%')
                          ->orWhere('firstname', 'like', '%' . $this->search . '%')
                          ->orWhere('lastname', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('id')
            ->get();
    }

    /**
     * Select a blotter
     */
    public function selectBlotter($blotterId): void
    {
        $this->form->blotter_id = $blotterId;
        
        // Get the blotter and populate the complaint field with its narration
        $blotter = Blotter::find($blotterId);
        if ($blotter && $blotter->narration) {
            $this->form->complaint = $blotter->narration;
        }
        
        $this->search = ''; // Clear search after selection
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
            'filteredBlotters' => $this->filteredBlotters,
        ]);
    }
}