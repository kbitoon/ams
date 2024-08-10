<?php

namespace App\Livewire;

use App\Models\ItemSchedule as ItemScheduleModel;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class ItemSchedule extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    /**
     * @return  Application|View|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.item.schedule', [
            'itemSchedules' => ItemScheduleModel::paginate(10),
        ]);
    }
}
