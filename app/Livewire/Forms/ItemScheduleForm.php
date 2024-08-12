<?php

namespace App\Livewire\Forms;

use App\Models\ItemSchedule;
use App\Models\Item;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ItemScheduleForm extends Form
{
    public ?ItemSchedule $itemSchedule = null;

    public string $location = '';
    public string $start = '';
    public string $end = '';
    public int $quantity = 0;
    public string $item_id = '';
    public string $status = '';
    public string $purpose = '';

    /**
     * @param ItemSchedule|null $itemSchedule
     */
    public function setItemSchedule(?ItemSchedule $itemSchedule = null): void
    {
        $this->location = $itemSchedule->location;
        $this->itemSchedule = $itemSchedule;
        $this->start = $itemSchedule->start;
        $this->end = $itemSchedule->end;
        $this->quantity = $itemSchedule->quantity;
        $this->item_id = $itemSchedule->item_id;
        $this->purpose = $itemSchedule->purpose;
        $this->status = $itemSchedule->status;
        
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'location' => ['required'],
            'start' => ['required', 'date', 'after_or_equal:today'],
            'end' => ['required', 'date', 'after:start'],
            'quantity' => ['required','integer', 'min:1', 'max:'.$this->getQuantityLeft()],
            'item_id' => ['required'],
            'purpose' => ['required'],
        ];
    }
    /**
     * Custom method to get the QuantityLeft for the selected item.
     *
     * @return int
     */
    protected function getQuantityLeft(): int
    {
        $item = Item::find($this->item_id);
        return $item ? $item->QuantityLeft : 0;
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'location' => 'location',
            'start' => 'start',
            'end' => 'end',
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
           ItemSchedule::create($this->only(['location', 'start', 'end',  'quantity','item_id', 'purpose', 'status']));
        } else {
            $this->itemSchedule->update($this->only(['location', 'start', 'end', 'quantity','item_id', 'purpose', 'status']));
        }
        
        $this->reset();
    }
}
