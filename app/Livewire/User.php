<?php

namespace App\Livewire;

use App\Models\User as UserModel;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    public string $search = '';
    public string $selectedRole = ''; 

    protected $updatesQueryString = ['search', 'selectedRole'];

    public function searchUsers()
    {
        $this->resetPage();
    }

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = UserModel::query();

        // Filter by selected role
        if ($this->selectedRole) {
            $query->whereHas('roles', function($q) {
                $q->where('name', $this->selectedRole);
            });
        }

        // Search by name
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $users = $query->paginate(10);
        
        $roles = Role::all(); // Fetch all roles

        return view('livewire.user-management.list', [
            'users' => $users,
            'roles' => $roles, // Pass roles to the view
        ]);
    }
}
