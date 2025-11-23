<?php

namespace App\Livewire;

use App\Models\DisasterEvent as DisasterEventModel;
use App\Models\DisasterType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class DisasterEvent extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $severityFilter = '';
    public string $typeFilter = '';

    protected $updatesQueryString = ['search', 'statusFilter', 'severityFilter', 'typeFilter'];

    #[On('refresh-list')]
    public function refresh() {}

    public function resetFilters()
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->severityFilter = '';
        $this->typeFilter = '';
        $this->resetPage();
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = DisasterEventModel::with(['disasterType', 'creator']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->severityFilter) {
            $query->where('severity', $this->severityFilter);
        }

        if ($this->typeFilter) {
            $query->where('disaster_type_id', $this->typeFilter);
        }

        $events = $query->orderBy('start_date', 'desc')->paginate(10);
        $types = DisasterType::where('is_active', true)->orderBy('name')->get();

        return view('livewire.disaster-event.list', [
            'events' => $events,
            'types' => $types,
        ]);
    }
}

