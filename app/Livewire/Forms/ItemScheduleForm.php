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
    public array $items = [['item_id' => '', 'quantity' => '']];
    public string $purpose = '';
    public string $status = 'Pending';
    public string $assigned = '';

    public function setItemSchedule(?ItemSchedule $itemSchedule = null): void
    {
        if ($itemSchedule) {
            $this->itemSchedule = $itemSchedule;
            $this->location = $itemSchedule->location;
            $this->start = $itemSchedule->start;
            $this->end = $itemSchedule->end;
            $this->purpose = $itemSchedule->purpose;
            $this->status = $itemSchedule->status;
            $this->assigned = $itemSchedule->assigned;
            // Set the items array with the current item
            $this->items = [[
                'item_id' => $itemSchedule->item_id,
                'quantity' => $itemSchedule->quantity
            ]];
        }
    }

    public function rules(): array
    {
        return [
            'location' => ['required'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date', 'after:start'],
            'items.*.item_id' => ['required'],
            'items.*.quantity' => ['required', 'numeric', 'min:1'],
            'purpose' => ['required'],
            'assigned' => ['required'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'location' => 'location',
            'start' => 'start',
            'end' => 'end',
            'items.*.item_id' => 'item',
            'items.*.quantity' => 'quantity',
            'purpose' => 'purpose',
            'assigned' => 'assigned',
            'status' => ['required'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        foreach ($this->items as $item) {
            if ($this->itemSchedule) {
                // Update existing record
                $this->itemSchedule->update([
                    'location' => $this->location,
                    'start' => $this->start,
                    'end' => $this->end,
                    'quantity' => $item['quantity'],
                    'item_id' => $item['item_id'],
                    'purpose' => $this->purpose,
                    'status' => $this->status,
                    'assigned' => $this->assigned,
                ]);
            } else {
                // Create new record
                ItemSchedule::create([
                    'location' => $this->location,
                    'start' => $this->start,
                    'end' => $this->end,
                    'quantity' => $item['quantity'],
                    'item_id' => $item['item_id'],
                    'purpose' => $this->purpose,
                    'status' => $this->status,
                    'assigned' => $this->assigned,
                ]);
            }
        }

        $this->reset();
    }
}
