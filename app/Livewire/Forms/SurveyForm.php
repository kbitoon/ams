<?php

namespace App\Livewire\Forms;

use App\Models\Survey;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use Illuminate\Database\Eloquent\Collection;

class SurveyForm extends Form
{
    public ?Survey $survey = null;
    public string $mayor_id = ''; // Changed to mayor_id for clarity
    public string $viceMayor_id = ''; // New property for Vice Mayor
    public string $congress_id = ''; // New property for Congress
    public array $selectedCouncilors = [];
    public Collection $candidates;

    public function __construct()
    {
        $this->candidates = new Collection();
    }

    public function setSurvey(?Survey $survey = null): void
    {
        $this->survey = $survey;
        if ($survey) {
            $this->mayor_id = $survey->candidate_id; // Set the mayor_id from survey
            // Here you should load the vice mayor and congress IDs as well, if needed
        }
    }

    public function rules(): array
    {
        return [
            'mayor_id' => ['required'],
            'viceMayor_id' => ['required'], // Validation rule for Vice Mayor
            'congress_id' => ['required'], // Validation rule for Congress
            'selectedCouncilors' => ['array', 'max:8'],
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

        // Save selected Councilors
        foreach ($this->selectedCouncilors as $councilorId) {
            Survey::create([
                'candidate_id' => $councilorId,
            ]);
        }
    }
}
