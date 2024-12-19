<?php

namespace App\Livewire;

use App\Models\Todo as TodoModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Todo extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $listeners = ['refreshTodoList' => 'refresh'];

        
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

        if ($user->hasAnyRole(['superadmin', 'administrator'])) {
            $todos = $query
                ->orderBy('is_completed', 'asc')
                ->orderByRaw('CASE WHEN is_completed = 0 THEN due_date END DESC')
                ->orderByRaw('CASE WHEN is_completed = 1 THEN due_date END DESC') 
                ->paginate(10);
        } else {
            $todos = $query
                ->where(function ($q) use ($user) {
                    $q->where('assigned_user_id', $user->id)
                    ->orWhere('user_id', $user->id);
                })
                ->orWhereHas('role', function ($q) use ($user) {
                    $q->whereIn('id', $user->roles->pluck('id'));
                })
                ->orderBy('is_completed', 'asc')
                ->orderByRaw('CASE WHEN is_completed = 0 THEN due_date END DESC') 
                ->orderByRaw('CASE WHEN is_completed = 1 THEN due_date END DESC')
                ->paginate(10);
        }

        return view('livewire.todo.list', [
            'todos' => $todos,
        ]);
    }
}