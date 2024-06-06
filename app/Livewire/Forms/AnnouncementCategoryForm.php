<?php

namespace App\Livewire\Forms;

use App\Models\AnnouncementCategory;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class AnnouncementCategoryForm extends Form
{
    public ?AnnouncementCategory $announcementCategory = null;

    public string $name = '';
    public string $icon = '';

    /**
     * @param AnnouncementCategory|null $announcementCategory
     */
    public function setAnnouncementCategory(?AnnouncementCategory $announcementCategory = null): void
    {
        $this->announcementCategory = $announcementCategory;
        $this->name = $announcementCategory->name;
        $this->icon = $announcementCategory->icon ?? '';
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
            AnnouncementCategory::create($this->only(['name', 'icon']));
        } else {
            $this->announcementCategory->update($this->only(['name', 'icon']));
        }
        $this->reset();
    }
}
