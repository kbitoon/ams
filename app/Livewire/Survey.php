<?php

namespace App\Livewire;

use App\Models\Survey as SurveyModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Survey extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    public function delete($id)
    {
        $survery = SurveyModel::findOrFail($id);
        $survery->delete();
        
        $this->dispatch('refresh-list');
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        // Fetch the candidate IDs and their survey counts
        $surveys = SurveyModel::select('candidate_id')
        ->selectRaw('count(*) as votes')
        ->groupBy('candidate_id')
        ->join('candidates', 'surveys.candidate_id', '=', 'candidates.id')
        ->orderByRaw("CASE WHEN candidates.position = 'Mayor' THEN 1 ELSE 2 END")
        ->with('candidate')
        ->paginate(10);

        return view('livewire.campaign-iq.survey', [
            'surveys' => $surveys, // Pass survey data to the view
        ]);
    }

}
