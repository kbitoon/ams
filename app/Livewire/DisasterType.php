<?php

namespace App\Livewire;

use App\Models\DisasterType as DisasterTypeModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class DisasterType extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';

    protected $updatesQueryString = ['search'];

    #[On('refresh-list')]
    public function refresh() {}

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = DisasterTypeModel::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $types = $query->where('is_active', true)->orderBy('name')->paginate(10);

        return view('livewire.disaster-type.list', [
            'types' => $types,
        ]);
    }
}

