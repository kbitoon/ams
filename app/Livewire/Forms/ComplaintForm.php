<?php

namespace App\Livewire\Forms;

use App\Models\Complaint;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ComplaintForm extends Form
{
    public ?Complaint $complaint = null;

    public string $title = '';
    public string $content = '';
    public string $category_id = '';
    public int $is_pinned = 0;
    public int $user_id = 1; // default to anonymous user, make sure we have this seeded

    /**
     * @param Complaint|null $complaint
     */
    public function setComplaint(?Complaint $complaint = null): void
    {
        $this->complaint = $complaint;
        $this->title = $complaint->title;
        $this->content = $complaint->content;
        $this->category_id = $complaint->category_id;
        $this->is_pinned = $complaint->is_pinned;
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
        if (!$this->complaint) {
            if (auth()->user()) {
                $this->complaint = auth()->user()->complaints()->create($this->only(['title', 'user_id', 'content', 'category_id', 'is_pinned']));
            } else {
                $this->complaint = Complaint::create($this->only(['title', 'user_id', 'content', 'category_id', 'is_pinned']));
            }
        } else {
            $this->complaint->update($this->only(['title', 'content', 'category_id', 'is_pinned']));
        }
        $this->reset();
    }
}
