<?php

namespace App\Livewire;

use App\Models\Clearance as ClearanceModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Clearance extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    public function markAsDone($clearanceId)
    {
        $clearance = ClearanceModel::find($clearanceId);

        if ($clearance) {
            $clearance->status = 'done';
            $clearance->approved_by = auth()->user()->id;
            $clearance->save();
        }
        
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (auth()->user()->hasRole('superadmin|admin')) {
            $clearances = ClearanceModel::with('assets')->paginate(10);
        } else {
            $clearances = ClearanceModel::with('assets')->where('user_id', auth()->user()->id)->paginate(10);
        }
        return view('livewire.clearance.list', [
            'clearances' => $clearances,
        ]);
    }
}
