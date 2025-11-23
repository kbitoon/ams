<?php

namespace App\Livewire;

use App\Models\DisasterReport as DisasterReportModel;
use App\Models\DisasterEvent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class DisasterReport extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $typeFilter = '';
    public string $eventFilter = '';
    public string $startDate = '';
    public string $endDate = '';

    protected $updatesQueryString = ['search', 'typeFilter', 'eventFilter', 'startDate', 'endDate'];

    #[On('refresh-list')]
    public function refresh() {}

    public function mount()
    {
        $this->startDate = now()->subDays(30)->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->typeFilter = '';
        $this->eventFilter = '';
        $this->startDate = now()->subDays(30)->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
        $this->resetPage();
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = DisasterReportModel::with(['disasterEvent', 'generatedBy']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->typeFilter) {
            $query->where('report_type', $this->typeFilter);
        }

        if ($this->eventFilter) {
            $query->where('disaster_event_id', $this->eventFilter);
        }

        if ($this->startDate) {
            $query->whereDate('report_date', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('report_date', '<=', $this->endDate);
        }

        $reports = $query->orderBy('report_date', 'desc')->paginate(10);
        $events = DisasterEvent::orderBy('title')->get();

        return view('livewire.disaster-report.list', [
            'reports' => $reports,
            'events' => $events,
        ]);
    }
}

