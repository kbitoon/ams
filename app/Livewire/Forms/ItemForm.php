<?php

namespace App\Livewire\Forms;

use App\Models\Item;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ItemForm extends Form
{
    public ?Item $item = null;

    public string $name = '';
    public string $TotalQuantity = '';
    public string $QuantityLeft = '';
    public string $category_id = '';

    /**
     * @param Item|null $item
     */
    public function setItem(?Item $item = null): void
    {
        $this->item = $item;
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
            'name' => ['required'],
            'TotalQuantity' => ['required'],
            'QuantityLeft' => ['required'],
            'category_id' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
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
            Item::create($this->only(['name', 'TotalQuantity', 'QuantityLeft', 'category_id']));
        } else {
            $this->item->update($this->only(['name', 'TotalQuantity', 'QuantityLeft', 'category_id']));
        }
        $this->reset();
    }
}
