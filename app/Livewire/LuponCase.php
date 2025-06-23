<?php

namespace App\Livewire;

use App\Models\LuponEventTracking;
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

    public $chartData = [];
    public $selectedYear;
    public $availableYears = [];


    public $pendingCount, $settledCount, $mediatedCount, $conciliatedCount;

    public function mount()
    {
        $this->pendingCount = LuponCaseModel::where('status', 'pending')->count();
        $this->mediatedCount = LuponCaseModel::where('status', 'mediation')->count();
        $this->conciliatedCount = LuponCaseModel::where('status', 'Conciliated by Pangkat')->count();
        $this->settledCount = LuponCaseModel::where(function ($query) {
            $query->where('settled', '1')
                ->orWhere('status', 'settled');
        })->count();
        // Get distinct years from LuponCaseModel based on the 'date' column
        $this->availableYears = LuponCaseModel::selectRaw('YEAR(date) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray();

        $this->selectedYear = !empty($this->availableYears) ? $this->availableYears[0] : date('Y');

        $this->loadChartData();
    }
    public function updatedSelectedYear()
    {
        $this->loadChartData();
    }

    public function loadChartData()
    {
        // Get all months for the selected year
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = $this->selectedYear . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        // Get the actual data
        $data = LuponCaseModel::selectRaw("
                DATE_FORMAT(date, '%Y-%m') as month, 
                COUNT(*) as total_cases, 
                SUM(CASE WHEN settled = 0 THEN 1 ELSE 0 END) as unsolved_cases
            ")
            ->whereYear('date', $this->selectedYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        // Prepare the data arrays
        $chartData = [
            'labels' => $months,
            'total_cases' => [],
            'unsolved_cases' => []
        ];

        // Fill in the data arrays, using 0 for missing months
        foreach ($months as $month) {
            $chartData['total_cases'][] = $data[$month]->total_cases ?? 0;
            $chartData['unsolved_cases'][] = $data[$month]->unsolved_cases ?? 0;
        }

        $this->chartData = $chartData;

        // Dispatch the event with the chart data
        $this->dispatch('updateChart', chartData: $this->chartData);
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
        $this->mediatedCount = $query->where('status', 'mediation')->count();
        $this->conciliatedCount = $query->where('status', 'Conciliated by Pangkat')->count();
        $this->settledCount = $query->where('settled', '1')->count();
    }

    #[On('refresh-list')]
    public function refresh() {}

    public function searchCase()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $luponCase = LuponCaseModel::find($id);

        if ($luponCase) {
            // Store the event tracking before deletion
            LuponEventTracking::create([
                'user_id' => auth()->id(),  // Get the current authenticated user ID
                'event_description' => 'Deleted Lupon Case with Case Number: ' . $luponCase->case_no,  // Event description for deletion
            ]);
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
