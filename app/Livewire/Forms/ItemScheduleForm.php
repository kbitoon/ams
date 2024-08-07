<?php

namespace App\Livewire\Forms;

use App\Models\ItemSchedule;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use Carbon\Carbon;

class ItemScheduleForm extends Form
{
    public ?ItemSchedule $itemSchedule = null;

    public string $start = '';
    public string $end = '';
    public string $location = '';
    public string $quantity = '';
    public string $item_id = '';
    public string $status = '';
    public string $purpose = '';

    /**
     * @param ItemSchedule|null $itemSchedule
     */
    public function setItemSchedule(?ItemSchedule $itemSchedule = null): void
    {
        if($itemSchedule){
        $this->itemSchedule = $itemSchedule;
        $this->start = $itemSchedule->start;
        $this->end = $itemSchedule->end;
        $this->location = $itemSchedule->location;
        $this->quantity = $itemSchedule->quantity;
        $this->item_id = $itemSchedule->item_id;
        $this->purpose = $itemSchedule->purpose;
        $this->status = $itemSchedule->status;
        }
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'start' => ['required', 'date', 'after_or_equal:today'],
            'end' => ['required', 'date', 'after:start'],
            'location' => ['required'],
            'quantity' => ['required'],
            'item_id' => ['required'],
            'purpose' => ['required'],
            'status' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'start' => 'start',
            'end' => 'end',
            'location' => 'location',
            'quantity' => 'quantity',
            'item_id' => 'item',
            'purpose' => 'purpose',
            'status' => 'status',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        if (!$this->itemSchedule) {
           ItemSchedule::create($this->only(['start', 'end', 'location', 'quantity','item_id', 'purpose', 'status']));
        } else {
            $this->itemSchedule->update($this->only(['start', 'end', 'location', 'quantity','item_id', 'purpose', 'status']));
        }
        
        $this->reset();
    }
}
