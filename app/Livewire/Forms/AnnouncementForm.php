<?php

namespace App\Livewire\Forms;

use App\Models\Announcement;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AnnouncementForm extends Form
{
    use WithFileUploads;

    public ?Announcement $announcement = null;

    public string $title = '';
    public string $content = '';
    public string $category_id = '';
    public int $is_pinned = 0;
    public $image = null;
    public string $image_position = 'before';
    public ?string $existing_image = null;

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
        $this->image_position = $announcement->image_position ?? 'before';
        $this->existing_image = $announcement->image_path;
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
            'image' => ['nullable', 'image', 'max:5120'], // 5MB max
            'image_position' => ['required', 'in:before,after'],
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
        
        $data = [
            'title' => $this->title,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'is_pinned' => $this->is_pinned,
            'image_position' => $this->image_position,
        ];

        // Handle image upload
        if ($this->image) {
            // Delete old image if exists
            if ($this->announcement && $this->announcement->image_path) {
                Storage::disk('public')->delete($this->announcement->image_path);
            }
            // Store new image
            $data['image_path'] = $this->image->store('announcements', 'public');
        } elseif ($this->announcement && $this->announcement->image_path) {
            // Keep existing image if no new image uploaded
            $data['image_path'] = $this->announcement->image_path;
        }

        if (!$this->announcement) {
            $announcement = auth()->user()->announcements()->create($data);
        } else {
            $this->announcement->update($data);
        }
        $this->reset();
    }

    public function removeImage(): void
    {
        if ($this->announcement && $this->announcement->image_path) {
            Storage::disk('public')->delete($this->announcement->image_path);
            $this->announcement->update(['image_path' => null]);
            $this->existing_image = null;
        }
        $this->image = null;
    }
}
