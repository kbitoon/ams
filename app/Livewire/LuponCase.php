<?php

namespace App\Livewire;

use App\Models\LuponCase as LuponCaseModel;
use App\Models\LuponCaseComplainant as LuponCaseComplainantModel;
use App\Models\LuponCaseRespondent as LuponCaseRespondentModel;
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

    public $search = '';
    public $status = '';
    public $startDate = '';
    public $endDate = '';

    public $pendingCount, $resolvedCount, $solvedCount, $dismissedCount, $rejectedCount, $withdrawnCount, $unsolvedCount;

    public function mount()
    {
        $this->pendingCount = LuponCaseModel::where('status', 'pending')->count();
        $this->resolvedCount = LuponCaseModel::where('status', 'resolved')->count();
        $this->solvedCount = LuponCaseModel::where('status', 'solved')->count();
        $this->dismissedCount = LuponCaseModel::where('status', 'dismissed')->count();
        $this->rejectedCount = LuponCaseModel::where('status', 'rejected')->count();
        $this->withdrawnCount = LuponCaseModel::where('status', 'withdrawn')->count();
        $this->unsolvedCount = LuponCaseModel::where('status', 'unsolved')->count();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['startDate', 'endDate'])) {
            $this->updateCounts();
        }
    }

    public function updateCounts()
    {
        $query = LuponCaseModel::query();

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('date', [$this->startDate, $this->endDate]);
        }

        $this->pendingCount = $query->where('status', 'pending')->count();
        $this->resolvedCount = $query->where('status', 'resolved')->count();
        $this->solvedCount = $query->where('status', 'solved')->count();
        $this->dismissedCount = $query->where('status', 'dismissed')->count();
        $this->rejectedCount = $query->where('status', 'rejected')->count();
        $this->withdrawnCount = $query->where('status', 'withdrawn')->count();
        $this->unsolvedCount = $query->where('status', 'unsolved')->count();
    }

    #[On('refresh-list')]
    public function refresh() {}

    public function searchCase()
    {
        $this->resetPage();
    }

    public function getPendingCountProperty()
    {
        return LuponCase::where('status', 'pending')->count();
    }

    public function getResolvedCountProperty()
    {
        return LuponCase::where('status', 'resolved')->count();
    }

    public function getSolvedCountProperty()
    {
        return LuponCase::where('status', 'solved')->count();
    }

    public function getDismissedCountProperty()
    {
        return LuponCase::where('status', 'dismissed')->count();
    }

    public function delete($id)
    {
        $luponCase = LuponCaseModel::find($id);
        
        if ($luponCase) {
            // Check if there are any associated assets (resolution files)
            foreach ($luponCase->assets as $asset) {
                if (file_exists(storage_path('app/public/' . $asset->path))) {
                    // Delete the resolution file from storage
                    unlink(storage_path('app/public/' . $asset->path));
                }
            }
            
            // Delete the associated assets from the database
            $luponCase->assets()->delete();  // Delete related assets records
            
            // Now delete the case
            $luponCase->delete();  // Delete the LuponCase record itself
            
            session()->flash('message', 'Case deleted successfully.');
        } else {
            session()->flash('error', 'Case not found.');
        }
    }
    



    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = LuponCaseModel::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('case_no', 'like', "%{$this->search}%")
                  ->orWhere('title', 'like', "%{$this->search}%")
                  ->orWhereHas('luponCaseComplainants', function ($subQuery) {
                      $subQuery->where('firstname', 'like', "%{$this->search}%")
                               ->orWhere('middlename', 'like', "%{$this->search}%")
                               ->orWhere('lastname', 'like', "%{$this->search}%");
                  })
                  ->orWhereHas('luponCaseRespondents', function ($subQuery) {
                      $subQuery->where('firstname', 'like', "%{$this->search}%")
                               ->orWhere('middlename', 'like', "%{$this->search}%")
                               ->orWhere('lastname', 'like', "%{$this->search}%");
                  });
            });
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('date', [$this->startDate, $this->endDate]);
        }

        return view('livewire.lupon-case.listing', [
            'luponCases' => $query->orderBy('date', 'desc')->paginate(10),
        ]);
    }
}
