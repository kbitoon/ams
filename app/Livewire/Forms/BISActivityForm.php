<?php

namespace App\Livewire\Forms;

use App\Models\BISActivity;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class BISActivityForm extends Form
{
    public ?BISActivity $bisActivity = null;

    public string $start = '';
    public string $end = '';
    public string $description = '';
    public string $location = '';

    /**
     * @param BISActivity|null $bisActivity
     */
    public function setBISActivity(?BISActivity $bisActivity = null): void
    {
        $this->bisActivity = $bisActivity;
        $this->start = $bisActivity->start;
        $this->end = $bisActivity->end;
        $this->description = $bisActivity->description;
        $this->location = $bisActivity->location;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'start' => ['required'],
            'end' => ['required'],
            'description' => ['required'],
            'location' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
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
        if (!$this->bisActivity) {
            $bisActivity = BISActivity::create($this->only(['start', 'end', 'description', 'location']));
        } else {
            $this->bisActivity->update($this->only(['start', 'end', 'description', 'location']));
        }
        $this->reset();
    }
}
