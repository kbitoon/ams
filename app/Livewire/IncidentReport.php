<?php

namespace App\Livewire;

use App\Models\IncidentReport as IncidentReportModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class IncidentReport extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';

    protected $updatesQueryString = ['search'];

    #[On('refresh-list')]
    public function refresh() {}

    public function resetFilters()
    {
        $this->search = '';
        $this->resetPage();
    }

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = IncidentReportModel::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('name', 'like', '%' . $this->search . '%')
                  ->orWhere('narration', 'like', '%' . $this->search . '%');
            });
        }

        $incidentReports = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.incident-report.list', [
            'incidentReports' => $incidentReports,
        ]);
    }
}
 