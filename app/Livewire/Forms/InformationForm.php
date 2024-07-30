<?php

namespace App\Livewire\Forms;

use App\Models\Information;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class InformationForm extends Form
{
    public ?Information $information = null;

    public string $title = '';
    public string $content = '';
    public string $category_id = '';
    public int $is_pinned = 0;
    public int $public = 0;

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
        if (!$this->information) {
            $information = auth()->user()->informations()->create($this->only(['title', 'content', 'category_id', 'is_pinned', 'public']));
        } else {
            $this->information->update($this->only(['title', 'content', 'category_id', 'is_pinned', 'public']));
        }
        $this->reset();
    }
}
