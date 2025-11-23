<?php

namespace App\Livewire;

use App\Models\DisasterResource as DisasterResourceModel;
use App\Models\DisasterEvent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class DisasterResource extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $typeFilter = '';
    public string $statusFilter = '';
    public string $eventFilter = '';

    protected $updatesQueryString = ['search', 'typeFilter', 'statusFilter', 'eventFilter'];

    #[On('refresh-list')]
    public function refresh() {}

    public function resetFilters()
    {
        $this->search = '';
        $this->typeFilter = '';
        $this->statusFilter = '';
        $this->eventFilter = '';
        $this->resetPage();
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = DisasterResourceModel::with(['disasterEvent', 'assignedTo', 'assignedTeam']);

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->typeFilter) {
            $query->where('resource_type', $this->typeFilter);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->eventFilter) {
            $query->where('disaster_event_id', $this->eventFilter);
        }

        $resources = $query->orderBy('name')->paginate(10);
        $events = DisasterEvent::where('status', 'active')->orderBy('title')->get();

        return view('livewire.disaster-resource.list', [
            'resources' => $resources,
            'events' => $events,
        ]);
    }
}
