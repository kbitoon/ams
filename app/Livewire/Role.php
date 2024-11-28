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

    public string $search = '';
    public string $selectedColor = '';

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

        // Filter by color (if needed)
        if ($this->selectedColor) {
            $query->where('color', 'like', '%' . $this->selectedColor . '%');
        }

        // Search by role name
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $roles = $query->paginate(10);

        return view('livewire.user-management.role', [
            'roles' => $roles,
        ]);
    }

    /**
     * Method to trigger refresh.
     */
    public function searchRoles()
    {
        $this->resetPage();
    }
}
