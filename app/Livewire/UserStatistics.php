<?php

namespace App\Livewire;

use App\Models\UserStatistics as UserStatisticsModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class UserStatistics extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    public function delete($id)
    {
        $userStatistics = UserStatisticsModel::findOrFail($id);
        $userStatistics->delete();

        $this->dispatch('refresh-list');
    }

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('livewire.user-statistics', [
            'statistics' => UserStatisticsModel::paginate(10),
        ]);
    }
}
