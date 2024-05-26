<?php

namespace App\Livewire\Forms;

use App\Models\ComplaintCategory;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ComplaintCategoryForm extends Form
{
    public ?ComplaintCategory $complaintCategory = null;

    public string $name = '';

    /**
     * @param ComplaintCategory|null $complaintCategory
     */
    public function setComplaintCategory(?ComplaintCategory $complaintCategory = null): void
    {
        $this->complaintCategory = $complaintCategory;
        $this->name = $complaintCategory->name;
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
        if (!$this->complaintCategory) {
            ComplaintCategory::create($this->only(['name']));
        } else {
            $this->complaintCategory->update($this->only(['name']));
        }
        $this->reset();
    }
}
