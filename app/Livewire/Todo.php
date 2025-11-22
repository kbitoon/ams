<?php

namespace App\Livewire;

use App\Models\Todo as TodoModel;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Todo extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $filterAssignedUserId = '';
    public $filterCompleted = '';
    public $userSearch = '';

    protected $listeners = ['refreshTodoList' => 'refresh'];

    public function updatedFilterAssignedUserId()
    {
        $this->resetPage();
    }

    public function updatedFilterCompleted()
    {
        $this->resetPage();
    }

    public function updatedUserSearch()
    {
        // Reset selected user if search changes and doesn't match
        if ($this->filterAssignedUserId) {
            $selectedUser = User::find($this->filterAssignedUserId);
            if ($selectedUser && !str_contains(strtolower($selectedUser->name), strtolower($this->userSearch))) {
                // Keep the selection if it still matches, otherwise don't auto-clear
            }
        }
    }

    public function selectUser($userId): void
    {
        $this->filterAssignedUserId = $userId;
        $selectedUser = User::find($userId);
        $this->userSearch = $selectedUser ? $selectedUser->name : '';
        $this->resetPage();
    }

    public function clearUserFilter(): void
    {
        $this->filterAssignedUserId = '';
        $this->userSearch = '';
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->filterAssignedUserId = '';
        $this->filterCompleted = '';
        $this->userSearch = '';
        $this->resetPage();
    }
        
    #[On('refresh-list')]
    public function refresh()
    {
        $this->resetPage();
    }
    public function delete(int $id): void
    {
        $todo = TodoModel::findOrFail($id);

        $todo->delete();

        $this->resetPage();
    }

    /**
     * Toggle the completion status of a todo.
     */
    public function toggleComplete(int $id): void
    {
        $todo = TodoModel::findOrFail($id);
        $todo->update(['is_completed' => !$todo->is_completed]);
        $this->resetPage();
    }

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $user = Auth::user();

        $query = TodoModel::query();

        // Apply filters
        if ($this->filterAssignedUserId) {
            $query->where('assigned_user_id', $this->filterAssignedUserId);
        }

        if ($this->filterCompleted !== '') {
            $query->where('is_completed', $this->filterCompleted === '1');
        }

        if ($user->hasAnyRole(['superadmin', 'administrator'])) {
            $todos = $query
                ->orderBy('is_completed', 'asc')
                ->orderByRaw('CASE WHEN is_completed = 0 THEN due_date END DESC')
                ->orderByRaw('CASE WHEN is_completed = 1 THEN due_date END DESC') 
                ->paginate(10);
        } else {
            // Non-admin users can only see tasks assigned to them
            $todos = $query
                ->where('assigned_user_id', $user->id)
                ->orderBy('is_completed', 'asc')
                ->orderByRaw('CASE WHEN is_completed = 0 THEN due_date END DESC') 
                ->orderByRaw('CASE WHEN is_completed = 1 THEN due_date END DESC')
                ->paginate(10);
        }

        // Get users for filter dropdown (only for admins)
        $users = collect([]);
        $filteredUsers = collect([]);
        
        if ($user->hasAnyRole(['superadmin', 'administrator'])) {
            $users = User::orderBy('name')->get();
            
            // Filter users based on search
            if ($this->userSearch) {
                $filteredUsers = $users->filter(function ($user) {
                    return str_contains(strtolower($user->name), strtolower($this->userSearch)) ||
                           str_contains(strtolower($user->email), strtolower($this->userSearch));
                });
            } else {
                $filteredUsers = $users;
            }
        }

        return view('livewire.todo.list', [
            'todos' => $todos,
            'users' => $users,
            'filteredUsers' => $filteredUsers,
        ]);
    }
}