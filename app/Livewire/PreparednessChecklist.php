<?php

namespace App\Livewire;

use App\Models\PreparednessChecklist as PreparednessChecklistModel;
use App\Models\DisasterType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class PreparednessChecklist extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $typeFilter = '';

    protected $updatesQueryString = ['search', 'typeFilter'];

    #[On('refresh-list')]
    public function refresh() {}

    public function resetFilters()
    {
        $this->search = '';
        $this->typeFilter = '';
        $this->resetPage();
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = PreparednessChecklistModel::with(['disasterType']);

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->typeFilter) {
            $query->where('disaster_type_id', $this->typeFilter);
        }

        $checklists = $query->where('is_active', true)->orderBy('order')->orderBy('title')->paginate(10);
        $types = DisasterType::where('is_active', true)->orderBy('name')->get();

        return view('livewire.preparedness-checklist.list', [
            'checklists' => $checklists,
            'types' => $types,
        ]);
    }
}

