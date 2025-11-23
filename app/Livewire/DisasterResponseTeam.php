<?php

namespace App\Livewire;

use App\Models\DisasterResponseTeam as DisasterResponseTeamModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class DisasterResponseTeam extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';

    protected $updatesQueryString = ['search'];

    #[On('refresh-list')]
    public function refresh() {}

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = DisasterResponseTeamModel::with(['teamLeader', 'activeMembers.user'])->withCount('activeMembers');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $teams = $query->where('is_active', true)->orderBy('name')->paginate(10);

        return view('livewire.disaster-response-team.list', [
            'teams' => $teams,
        ]);
    }
}
