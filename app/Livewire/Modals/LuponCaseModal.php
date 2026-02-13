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

    /** @var array Files for resolution forms - kept on component so multiple uploads hydrate correctly */
    public array $resolution_forms = [];

    public static function modalMaxWidth(): string
    {
        return '4xl'; // Same as detail modal for easier reading
    }

    /**
     * @param LuponCase|null $luponCase
     */
    public function mount(LuponCase $luponCase = null): void
    {
        if ($luponCase && $luponCase->exists) {
            $this->form->setLuponCase($luponCase);
        } else {
            $this->form->case_no = ''; // Auto-generated chronologically on save
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
        $case = $this->form->save();

        // Process resolution form uploads on the component (reliable for multiple files)
        $files = is_array($this->resolution_forms) ? $this->resolution_forms : [];
        if (!empty($this->resolution_forms) && $this->resolution_forms instanceof \Illuminate\Http\UploadedFile) {
            $files = [$this->resolution_forms];
        }
        $userId = auth()->id() ?? 1;
        foreach ($files as $index => $file) {
            if (!$file instanceof \Illuminate\Http\UploadedFile) {
                continue;
            }
            $filename = $file->getClientOriginalName();
            $uniqueName = (string) (time() + $index) . '-' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
            $path = $file->storePubliclyAs('resolution_forms/' . $userId, $uniqueName);
            $case->assets()->create(['path' => $path]);
        }

        $this->resolution_forms = [];
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    /**
     * @return View
     */
    public function render() : View
    {
        return view('livewire.forms.lupon-case-form',  [
           'filteredBlotters' => isset($this->search) ? $this->filteredBlotters : collect(),
        ]);
    }
}