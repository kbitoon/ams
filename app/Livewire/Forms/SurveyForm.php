<?php

namespace App\Livewire\Forms;

use App\Models\Survey;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use Illuminate\Database\Eloquent\Collection;

class SurveyForm extends Form
{
    public ?Survey $survey = null;
    public string $mayor_id = '';
    public string $viceMayor_id = '';
    public string $congress_id = '';
    public array $selectedCouncilors = [];

    public function setSurvey(?Survey $survey = null): void
    {
        $this->survey = $survey;
        if ($survey) {
            $this->mayor_id = $survey->candidate_id;
            $this->viceMayor_id = $survey->candidate_id;
            $this->congress_id = $survey->candidate_id;
            $this->selectedCouncilors = $survey->candidate_id;
        }
    }

    public function rules(): array
    {
        return [
            'mayor_id' => ['required'],
            'viceMayor_id' => ['required'],
            'congress_id' => ['required'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'mayor_id' => 'mayor_id',
            'viceMayor_id' => 'viceMayor_id',
            'congress_id' => 'congress_id',
            'selectedCouncilors' => 'selectedCouncilors',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (count($this->selectedCouncilors) > 8) {
            throw ValidationException::withMessages([
                'selectedCouncilors' => 'You can only select up to 8 councilors.',
            ]);
        }

        Survey::create([
            'candidate_id' => $this->mayor_id,
        ]);
        
        Survey::create([
            'candidate_id' => $this->viceMayor_id,
        ]);

        Survey::create([
            'candidate_id' => $this->congress_id,
        ]);

        foreach ($this->selectedCouncilors as $councilorId) {
            Survey::create([
                'candidate_id' => $councilorId,
            ]);
        }
        $this->reset();
    }
}
