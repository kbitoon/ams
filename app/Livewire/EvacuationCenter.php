<?php

namespace App\Livewire;

use App\Models\EvacuationCenter as EvacuationCenterModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class EvacuationCenter extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';

    protected $updatesQueryString = ['search'];

    #[On('refresh-list')]
    public function refresh() {}

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = EvacuationCenterModel::with(['contactPerson']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('address', 'like', '%' . $this->search . '%');
            });
        }

        $centers = $query->where('is_active', true)->orderBy('name')->paginate(10);

        return view('livewire.evacuation-center.list', [
            'centers' => $centers,
        ]);
    }
}
