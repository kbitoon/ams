<?php

namespace App\Livewire;

use App\Models\Activity as ActivityModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Activity extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    public function delete($id)
    {
        $activity = ActivityModel::findOrFail($id);
        $activity->delete();

        $this->dispatch('refresh-list');
    }

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('livewire.activity.list', [
            'activities' => ActivityModel::paginate(10),
        ]);
    }
}
