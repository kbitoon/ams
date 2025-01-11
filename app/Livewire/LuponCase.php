<?php

namespace App\Livewire;

use App\Models\LuponCase as LuponCaseModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class LuponCase extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('livewire.lupon-case.listing', [
            'luponCases' => LuponCaseModel::paginate(10),
        ]);
    }
}
