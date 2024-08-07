<?php

namespace App\Livewire\Forms;

use App\Models\ItemCategory;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ItemCategoryForm extends Form
{
    public ?ItemCategory $itemCategory = null;

    public string $name = '';

    /**
     * @param ItemCategory|null $itemCategory
     */
    public function setItemCategory(?ItemCategory $itemCategory = null): void
    {
        
        $this->itemCategory = $itemCategory;
        $this->name = $itemCategory->name;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->itemCategory) {
            ItemCategory::create($this->only(['name']));
        } else {
            $this->itemCategory->update($this->only(['name']));
        }
        $this->reset();
    }
}
