<?php

namespace App\Livewire;

use App\Models\ReliefOperation as ReliefOperationModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class ReliefOperation extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $startDate = '';
    public string $endDate = '';

    protected $updatesQueryString = ['search', 'statusFilter', 'startDate', 'endDate'];

    #[On('refresh-list')]
    public function refresh() {}

    public function resetFilters()
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->startDate = '';
        $this->endDate = '';
        $this->resetPage();
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = ReliefOperationModel::query()
            ->with(['creator', 'provider', 'reliefItems.reliefType'])
            ->withCount(['distributions', 'reliefItems']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('purpose', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->startDate) {
            $query->whereDate('operation_date', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('operation_date', '<=', $this->endDate);
        }

        $operations = $query->orderBy('operation_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.relief-operation.list', [
            'operations' => $operations,
        ]);
    }
}

