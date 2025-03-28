<?php

namespace App\Livewire;

use App\Models\LuponSummonTracking as LuponSummonTrackingModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class LuponSummonTracking extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    public function delete($id)
    {
        
        $luponSummonTracking = LuponSummonTrackingModel::findOrFail($id);
        $luponSummonTracking->delete();

        $this->dispatch('refresh-list');
    }


    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('livewire.lupon-case.summon', [
            'luponSummonTrackings' => LuponSummonTrackingModel::paginate(10),
        ]);
    }
}
