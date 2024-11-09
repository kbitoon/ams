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
    public string $barangay_list_id = '';
    public string $district = '';
    public array $attachments = [];

    /**
     * @param Activity|null $activity
     */
    public function setActivity(?Activity $activity = null): void
    {
            $this->activity = $activity;
            $this->date = $activity->date;
            $this->description = $activity->description;
            $this->location = $activity->location;
            $this->barangay_list_id = $activity->barangay_list_id;
            $this->district = $activity->district;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'date' => ['required'],
            'description' => ['required'],
            'location' => ['required'],
            'barangay_list_id' => ['required'],
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
            'barangay_list_id' => 'barangay_list_id',
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
            $this->activity = Activity::create($this->only(['date', 'description', 'location', 'barangay_list_id', 'district']));
        } else {
            $this->activity->update($this->only(['date', 'description', 'location', 'barangay_list_id', 'district']));
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
