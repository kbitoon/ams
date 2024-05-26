<?php

namespace App\Livewire;

use App\Models\Complaint as ComplaintModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;

class Complaint extends Component
{
    #[On('refresh-list')]
    public function refresh() {}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.complaint.list', [
            'complaints' => ComplaintModel::all(),
        ]);
    }
}
