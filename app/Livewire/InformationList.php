<?php

namespace App\Livewire;

use App\Models\Information as InformationModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class InformationList extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.information.information-list', [
            'informations' => InformationModel::where('public', '=', 1)->paginate(10),
        ]);
    }
}
