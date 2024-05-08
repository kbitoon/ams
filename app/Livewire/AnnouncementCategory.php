<?php

namespace App\Livewire;

use App\Models\AnnouncementCategory as AnnouncementCategoryModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class AnnouncementCategory extends Component
{
    #[On('refresh-list')]
    public function refresh() {}

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('livewire.announcement.category', [
            'announcementCategories' => AnnouncementCategoryModel::all(),
        ]);
    }
}
