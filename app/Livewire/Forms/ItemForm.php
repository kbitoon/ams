<?php

namespace App\Livewire\Forms;

use App\Models\Item;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ItemForm extends Form
{
    public ?Item $item = null;
    
    public string $acquired = '';
    public string $name = '';
    public int $TotalQuantity = 0;
    public int $QuantityLeft = 0;
    public string $category_id = '';

    /**
     * @param Item|null $item
     */
    public function setItem(?Item $item = null): void
    {
        $this->item = $item;
        $this->acquired = $item->$acquired;
        $this->name = $item->name;
        $this->TotalQuantity = $item->TotalQuantity;
        $this->QuantityLeft = $item->QuantityLeft;
        $this->category_id = $item->category_id;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'acquired' => ['required'],
            'name' => ['required'],
            'TotalQuantity' => ['required', 'integer', 'min:1'],
            'QuantityLeft' => ['required','integer', 'min:0', 'lte:TotalQuantity'],
            'category_id' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'acquired' => 'acquired',
            'name' => 'name',
            'TotalQuantity' => 'TotalQuantity',
            'QuantityLeft' => 'QuantityLeft',
            'category_id' => 'category',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->item) {
            Item::create($this->only(['acquired','name', 'TotalQuantity', 'QuantityLeft', 'category_id']));
        } else {
            $this->item->update($this->only(['name', 'TotalQuantity', 'QuantityLeft', 'category_id']));
        }
        $this->reset();
    }
}
