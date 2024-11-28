<?php

namespace App\Livewire;

use Spatie\Permission\Models\Role as Roles;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Role extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    /**
     * Search roles and filter by color.
     *
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = Roles::query();

        $roles = $query->paginate(10);

        return view('livewire.user-management.role', [
            'roles' => $roles,
        ]);
    }

}
