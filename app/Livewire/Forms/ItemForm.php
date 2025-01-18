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
    public string $description = '';
    public string $AcquisitionCost = '';
    public string $category_id = '';

    /**
     * @param Item|null $item
     */
    public function setItem(?Item $item = null): void
    {
        $this->item = $item;
        $this->acquired = $item->acquired;
        $this->name = $item->name;
        $this->TotalQuantity = $item->TotalQuantity;
        $this->QuantityLeft = $item->QuantityLeft;
        $this->description = $item->description;
        $this->AcquisitionCost = $item->AcquisitionCost;
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
            'description'=>['required'],
            'AcquisitionCost' => ['required', 'numeric', 'min:0'],
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
            'description' => 'description',
            'AcquisitionCost' => 'AcquisitionCost',
            'category_id' => 'category',
        ];
    }

    protected function cleanAcquisitionCost(): void
    {
        // Remove all commas and ensure the value is numeric
        $this->AcquisitionCost = str_replace(',', '', $this->AcquisitionCost);
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {

        $this->cleanAcquisitionCost();
        $this->validate();
        
        if (!$this->item) {
            Item::create($this->only(['acquired','name', 'TotalQuantity', 'QuantityLeft', 'description', 'AcquisitionCost', 'category_id']));
        } else {
            $this->item->update($this->only(['name', 'TotalQuantity', 'QuantityLeft', 'description', 'AcquisitionCost', 'category_id']));
        }
        $this->reset();
    }
}
