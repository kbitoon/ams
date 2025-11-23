<?php

namespace App\Livewire;

use App\Models\DisasterRecoveryActivity as DisasterRecoveryActivityModel;
use App\Models\DisasterEvent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class DisasterRecovery extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $eventFilter = '';

    protected $updatesQueryString = ['search', 'statusFilter', 'eventFilter'];

    #[On('refresh-list')]
    public function refresh() {}

    public function resetFilters()
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->eventFilter = '';
        $this->resetPage();
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = DisasterRecoveryActivityModel::with(['disasterEvent', 'responsiblePerson', 'assignedTeam']);

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->eventFilter) {
            $query->where('disaster_event_id', $this->eventFilter);
        }

        $activities = $query->orderBy('start_date', 'desc')->paginate(10);
        $events = DisasterEvent::orderBy('title')->get();

        return view('livewire.disaster-recovery.list', [
            'activities' => $activities,
            'events' => $events,
        ]);
    }
}
