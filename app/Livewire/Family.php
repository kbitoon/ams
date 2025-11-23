<?php

namespace App\Livewire;

use App\Models\Family as FamilyModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Family extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';

    protected $updatesQueryString = ['search'];

    #[On('refresh-list')]
    public function refresh() {}

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = FamilyModel::with(['headOfFamily', 'members.user'])
            ->withCount('members');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('family_name', 'like', '%' . $this->search . '%')
                  ->orWhereHas('headOfFamily', function($q) {
                      $q->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        $families = $query->orderBy('family_name')->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.family.list', [
            'families' => $families,
        ]);
    }
}

