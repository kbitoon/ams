<?php

namespace App\Livewire;

use App\Models\ReliefProvider as ReliefProviderModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class ReliefProvider extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $typeFilter = '';

    protected $updatesQueryString = ['search', 'typeFilter'];

    #[On('refresh-list')]
    public function refresh() {}

    public function resetFilters()
    {
        $this->search = '';
        $this->typeFilter = '';
        $this->resetPage();
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = ReliefProviderModel::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('contact_person', 'like', '%' . $this->search . '%');
        }

        if ($this->typeFilter) {
            $query->where('type', $this->typeFilter);
        }

        $providers = $query->orderBy('name')->paginate(10);

        return view('livewire.relief-provider.list', [
            'providers' => $providers,
        ]);
    }
}

