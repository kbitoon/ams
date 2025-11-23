<?php

namespace App\Livewire;

use App\Models\ReliefType as ReliefTypeModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class ReliefType extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';

    protected $updatesQueryString = ['search'];

    #[On('refresh-list')]
    public function refresh() {}

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = ReliefTypeModel::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $types = $query->orderBy('name')->paginate(10);

        return view('livewire.relief-type.list', [
            'types' => $types,
        ]);
    }
}

