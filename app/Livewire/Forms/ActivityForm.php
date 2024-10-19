<?php

namespace App\Livewire\Forms;

use App\Models\Activity;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ActivityForm extends Form
{
    public ?Activity $activity = null;

    public string $date = '';
    public string $description = '';
    public string $location = '';
    public string $barangay = '';
    public string $district = '';
    public array $attachments = [];

    /**
     * @param Activity|null $activity
     */
    public function setActivity(?Activity $activity = null): void
    {
        $this->activity = $activity;
        $this->date = $complaint->date;
        $this->description = $complaint->description;
        $this->location = $complaint->location;
        $this->barangay = $complaint->barangay;
        $this->district = $complaint->district;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'date' => ['required'],
            'description' => ['required'],
            'location' => ['required'],
            'barangay' => ['required'],
            'district' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'date' => 'date',
            'description' => 'description',
            'location' => 'location',
            'barangay' => 'barangay',
            'district' => 'district',
            'attachments' => 'attachment',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        if (!$this->activity) {
            $this->activity = Activity::create($this->only(['date', 'description', 'location', 'barangay', 'district']));
        } else {
            $this->activity->update($this->only(['date', 'description', 'location', 'barangay', 'district']));
        }

        foreach ($this->attachments as $attachment) {
            $id = auth()->id() ?? 1;
            $path = $attachment->storePubliclyAs('attachments/' . $id, time() . '-' . $attachment->getClientOriginalName());
            $this->activity->assets()->create([
                'path' => $path,
            ]);
        }

        $this->reset();
    }
}
