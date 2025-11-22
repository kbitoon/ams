<?php

namespace App\Livewire\Forms;

use App\Models\Information;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use Livewire\WithFileUploads;

class InformationForm extends Form
{
    use WithFileUploads;

    public ?Information $information = null;

    public string $title = '';
    public string $content = '';
    public string $category_id = '';
    public int $is_pinned = 0;
    public int $public = 0;
    public $attachments = [];

    /**
     * @param Information|null $information
     */
    public function setInformation(?Information $information = null): void
    {
        $this->information = $information;
        $this->title = $information->title;
        $this->content = $information->content;
        $this->category_id = $information->category_id;
        $this->is_pinned = $information->is_pinned;
        $this->public = $information->public;
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
            'attachments.*' => ['nullable', 'file', 'max:10240'], // 10MB max per file
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
        
        $information = null;
        if (!$this->information) {
            $information = auth()->user()->informations()->create($this->only(['title', 'content', 'category_id', 'is_pinned', 'public']));
        } else {
            $this->information->update($this->only(['title', 'content', 'category_id', 'is_pinned', 'public']));
            $information = $this->information;
        }

        // Handle file uploads
        if (!empty($this->attachments)) {
            foreach ($this->attachments as $attachment) {
                $id = auth()->id() ?? 1;
                $path = $attachment->storePubliclyAs('attachments/' . $id, time() . '-' . $attachment->getClientOriginalName());
                $information->assets()->create([
                    'path' => $path,
                ]);
            }
        }

        $this->reset();
    }
}
