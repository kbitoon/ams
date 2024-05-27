<?php

namespace App\Livewire;

use App\Models\Clearance as ClearanceModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;

class Clearance extends Component
{
    #[On('refresh-list')]
    public function refresh() {}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (auth()->user()->hasRole('superadmin|admin')) {
            $clearances = ClearanceModel::with('assets')->get();
        } else {
            $clearances = ClearanceModel::with('assets')->where('user_id', auth()->user()->id)->get();
        }
        return view('livewire.clearance.list', [
            'clearances' => $clearances,
        ]);
    }
}
