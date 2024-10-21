<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ActivityForm;
use App\Models\Activity;
use App\Models\BarangayList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;

class ActivityModal extends ModalComponent
{
    use WithFileUploads;

    public ?Activity $activity = null;
    public ActivityForm $form;
    public Collection $barangayLists;

    /**
     * @param Activity|null $activity
     */
    public function mount(Activity $activity = null): void
    {
        if ($activity && $activity->exists) {
            $this->form->setActivity($activity);
        }
        $this->barangayLists = BarangayList::orderBy('barangay')->get();
    }

    public function updatedFormBarangayListId($value)
    {
        \Log::info('Barangay selected: ' . $value);
        $barangayList = $this->barangayLists->first(function ($item) use ($value) {
            return $item->id == $value;
        });

        if ($barangayList) {
            \Log::info('District found: ' . $barangayList->district);
            $this->form->district = $barangayList->district;
        } else {
            \Log::info('No barangay found.');
            $this->form->district = '';
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
        return view('livewire.forms.activity-form', [
            'barangayLists'=> $this->barangayLists,
        ]);
        
    }
}

