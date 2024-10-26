<?php

namespace App\Livewire;

use App\Models\Survey as SurveyModel;
use Carbon\Carbon;
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

    public ?string $startDate = null;
    public ?string $endDate = null;

    #[On('refresh-list')]
    public function refresh() {}

    public function delete($id)
    {
        $survery = SurveyModel::findOrFail($id);
        $survery->delete();
        
        $this->dispatch('refresh-list');
    }

    public function filterByDate(): void
    {
        $this->resetPage();
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = SurveyModel::select('candidate_id')
            ->selectRaw('count(*) as votes')
            ->groupBy('candidate_id')
            ->join('candidates', 'surveys.candidate_id', '=', 'candidates.id')
            ->orderByRaw("CASE WHEN candidates.position = 'Mayor' THEN 1 ELSE 2 END")
            ->with('candidate');

            if ($this->startDate && $this->endDate) {
                $query->whereBetween('surveys.created_at', [
                    Carbon::parse($this->startDate)->startOfDay(),
                    Carbon::parse($this->endDate)->endOfDay(),
                ]);
            }

        $surveys = $query->paginate(10);

        return view('livewire.campaign-iq.survey', [
            'surveys' => $surveys,
        ]);
    }

}
