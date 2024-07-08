<?php

namespace App\Livewire\Forms;

use App\Models\InformationCategory;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class InformationCategoryForm extends Form
{
    public ?InformationCategory $informationCategory = null;

    public string $name = '';
    public string $icon = '';

    /**
     * @param InformationCategory|null $informationCategory
     */
    public function setInformationCategory(?InformationCategory $informationCategory = null): void
    {
        $this->informationCategory = $informationCategory;
        $this->name = $informationCategory->name;
        $this->icon = $informationCategory->icon ?? '';
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
        if (!$this->informationCategory) {
            InformationCategory::create($this->only(['name', 'icon']));
        } else {
            $this->informationCategory->update($this->only(['name', 'icon']));
        }
        $this->reset();
    }
}
