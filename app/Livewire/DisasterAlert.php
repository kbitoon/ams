<?php

namespace App\Livewire;

use App\Models\DisasterAlert as DisasterAlertModel;
use App\Models\DisasterEvent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class DisasterAlert extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $alertTypeFilter = '';
    public string $severityFilter = '';
    public string $eventFilter = '';
    public bool $activeOnly = true;

    protected $updatesQueryString = ['search', 'alertTypeFilter', 'severityFilter', 'eventFilter', 'activeOnly'];

    #[On('refresh-list')]
    public function refresh() {}

    public function resetFilters()
    {
        $this->search = '';
        $this->alertTypeFilter = '';
        $this->severityFilter = '';
        $this->eventFilter = '';
        $this->activeOnly = true;
        $this->resetPage();
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = DisasterAlertModel::with(['disasterEvent', 'issuedBy']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('message', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->alertTypeFilter) {
            $query->where('alert_type', $this->alertTypeFilter);
        }

        if ($this->severityFilter) {
            $query->where('severity', $this->severityFilter);
        }

        if ($this->eventFilter) {
            $query->where('disaster_event_id', $this->eventFilter);
        }

        if ($this->activeOnly) {
            $query->active();
        }

        $alerts = $query->orderBy('issued_at', 'desc')->paginate(10);
        $events = DisasterEvent::where('status', 'active')->orderBy('title')->get();

        return view('livewire.disaster-alert.list', [
            'alerts' => $alerts,
            'events' => $events,
        ]);
    }
}
