<?php

namespace App\Livewire\Forms;

use App\Models\Announcement;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class AnnouncementForm extends Form
{
    public ?Announcement $announcement = null;

    public string $title = '';
    public string $content = '';
    public string $category_id = '';
    public int $is_pinned = 0;

    /**
     * @param Announcement|null $announcement
     */
    public function setAnnouncement(?Announcement $announcement = null): void
    {
        $this->announcement = $announcement;
        $this->title = $announcement->title;
        $this->content = $announcement->content;
        $this->category_id = $announcement->category_id;
        $this->is_pinned = $announcement->is_pinned;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'content' => ['required'],
            'category_id' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'title' => 'title',
            'content' => 'content',
            'category_id' => 'category',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->announcement) {
            $announcement = auth()->user()->announcements()->create($this->only(['title', 'content', 'category_id', 'is_pinned']));
        } else {
            $this->announcement->update($this->only(['title', 'content', 'category_id', 'is_pinned']));
        }
        $this->reset();
    }
}
