<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\SurveyForm;
use App\Models\Survey;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class SurveyModal extends ModalComponent
{
    public ?Survey $survey = null;
    public SurveyForm $form;

    /**
     * @param Survey|null $survey
     */
    public function mount(Survey $survey = null): void
    {
        if ($survey && $survey->exists) {
            $this->form->setSurvey($survey);
        }
    }

    /**
     * Save clearance
     */
    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    /**
     * @return View
     */
    public function render() : View
    {
        return view('livewire.forms.survey-form');
    }
}
