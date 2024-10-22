<?php

namespace App\Livewire\Forms;

use App\Models\Survey;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class SurveyForm extends Form
{
    public ?Survey $survey = null;

    public string $candidate_id = '';
    public string $date = '';

    /**
     * @param Survey|null $survey
     */
    public function setSurvey(?Survey $survey = null): void
    {
        $this->survey = $survey;
        $this->candidate_id = $survey->candidate_id;
        $this->date = $survey->date;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'candidate_id' => ['required'],
            'date' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'candidate_id' => 'candidate_id',
            'date' => 'date',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->survey) {
            $survey = Survey::create($this->only(['candidate_id', 'date']));
        } else {
            $this->survey->update($this->only(['candidate_id', 'date']));
        }
        $this->reset();
    }
}
