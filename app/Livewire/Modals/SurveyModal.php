<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\SurveyForm;
use App\Models\Survey;
use App\Models\Candidate;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Database\Eloquent\Collection;

class SurveyModal extends ModalComponent
{
    public ?Survey $survey = null;
    public SurveyForm $form;
    public Collection $candidates;

    public function mount(Survey $survey = null): void
    {
        $this->candidates = Candidate::all();
        $this->form->candidates = $this->candidates;

        if ($survey && $survey->exists) {
            $this->form->setSurvey($survey);
        }
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render(): View
    {
        return view('livewire.forms.survey-form', [
            'candidates' => $this->candidates,
        ]);
    }
}

