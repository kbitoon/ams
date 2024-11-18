<?php

namespace App\Livewire\Forms;

use App\Models\Activity;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ActivityForm extends Form
{
    public ?Activity $activity = null;

    public string $title = '';
    public string $start = '';
    public string $end = '';
    public string $description = '';
    public string $location = '';

    /**
     * @param Activity|null $activity
     */
    public function setActivity(?Activity $activity = null): void
    {
        $this->activity = $activity;
        $this->title = $activity->title;
        $this->start = $activity->start;
        $this->end = $activity->end;
        $this->description = $activity->description;
        $this->location = $activity->location;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'start' => ['required', 'date','after_or_equal:today'],
            'end' => ['required', 'date','after:start' ],
            'description' => ['nullable'],
            'location' => ['nullable'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'title' => 'title',
            'start' => 'start',
            'end' => 'end',
            'description' => 'description',
            'location' => 'location',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->activity) {
            $activity = Activity::create($this->only(['title','start', 'end', 'description', 'location']));
        } else {
            $this->activity->update($this->only(['title','start', 'end', 'description', 'location']));
        }
        $this->reset();
    }
}
