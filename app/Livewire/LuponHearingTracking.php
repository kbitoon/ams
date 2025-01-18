<?php

namespace App\Livewire;

use App\Models\LuponHearingTracking as LuponHearingTrackingModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class LuponHearingTracking extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    public function delete($id)
    {
        
        $luponHearingTracking = LuponHearingTrackingModel::findOrFail($id);
        $luponHearingTracking->delete();

        $this->dispatch('refresh-list');
    }


    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('livewire.lupon-case.hearing', [
            'luponHearingTrackings' => LuponHearingTrackingModel::paginate(10),
        ]);
    }
}
