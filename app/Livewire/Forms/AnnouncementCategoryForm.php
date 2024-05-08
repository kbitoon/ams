<?php

namespace App\Livewire\Forms;

use App\Models\AnnouncementCategory;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class AnnouncementCategoryForm extends Form
{
    public ?AnnouncementCategory $announcementCategory = null;

    public string $name = '';
    public string $amount = '';

    /**
     * @param AnnouncementCategory|null $announcementCategory
     */
    public function setAnnouncementCategory(?AnnouncementCategory $announcementCategory = null): void
    {
        $this->announcementCategory = $announcementCategory;
        $this->name = $announcementCategory->name;
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
        if (!$this->announcementCategory) {
            AnnouncementCategory::create($this->only(['name']));
        } else {
            $this->announcementCategory->update($this->only(['name']));
        }
        $this->reset();
    }
}
