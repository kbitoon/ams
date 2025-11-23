<?php

namespace App\Livewire;

use App\Models\ReliefDistribution;
use App\Models\ReliefOperation;
use App\Models\ReliefType;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReliefReport extends Component
{
    public string $startDate = '';
    public string $endDate = '';
    public string $selectedOperationId = '';
    public string $selectedTypeId = '';

    public function mount()
    {
        $this->startDate = Carbon::now()->subDays(30)->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
    }

    public function resetFilters()
    {
        $this->startDate = Carbon::now()->subDays(30)->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->selectedOperationId = '';
        $this->selectedTypeId = '';
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $query = ReliefDistribution::query()
            ->with(['user', 'reliefOperation', 'reliefItem.reliefType', 'distributor', 'family.headOfFamily']);

        if ($this->startDate) {
            $query->whereDate('distributed_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('distributed_at', '<=', $this->endDate);
        }

        if ($this->selectedOperationId) {
            $query->where('relief_operation_id', $this->selectedOperationId);
        }

        if ($this->selectedTypeId) {
            $query->whereHas('reliefItem', function($q) {
                $q->where('relief_type_id', $this->selectedTypeId);
            });
        }

        // Total Statistics
        $totalDistributions = (clone $query)->count();
        $totalRecipients = (clone $query)->distinct('user_id')->count('user_id');
        $totalQuantity = (clone $query)->sum('quantity');
        $totalAmount = (clone $query)->sum('amount');

        // Distributions by Operation
        $byOperation = (clone $query)
            ->select('relief_operations.title', 'relief_operations.purpose', DB::raw('COUNT(*) as count'), DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(amount) as total_amount'))
            ->join('relief_operations', 'relief_distributions.relief_operation_id', '=', 'relief_operations.id')
            ->groupBy('relief_operations.id', 'relief_operations.title', 'relief_operations.purpose')
            ->orderBy('count', 'desc')
            ->get();

        // Distributions by Type
        $byType = (clone $query)
            ->select('relief_types.name', 'relief_types.unit', DB::raw('COUNT(*) as count'), DB::raw('SUM(quantity) as total_quantity'))
            ->join('relief_items', 'relief_distributions.relief_item_id', '=', 'relief_items.id')
            ->join('relief_types', 'relief_items.relief_type_id', '=', 'relief_types.id')
            ->groupBy('relief_types.id', 'relief_types.name', 'relief_types.unit')
            ->orderBy('count', 'desc')
            ->get();

        // Distributions by Provider
        $byProvider = (clone $query)
            ->select('relief_providers.name', 'relief_providers.type', DB::raw('COUNT(*) as count'), DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(amount) as total_amount'))
            ->join('relief_operations', 'relief_distributions.relief_operation_id', '=', 'relief_operations.id')
            ->leftJoin('relief_providers', 'relief_operations.provider_id', '=', 'relief_providers.id')
            ->groupBy('relief_providers.id', 'relief_providers.name', 'relief_providers.type')
            ->orderBy('count', 'desc')
            ->get();

        // Distributions by Type (Individual vs Family)
        $byDistributionType = (clone $query)
            ->select('distribution_type', DB::raw('COUNT(*) as count'), DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(amount) as total_amount'))
            ->groupBy('distribution_type')
            ->get();

        // Family Distributions Summary
        $familyDistributions = (clone $query)
            ->where('distribution_type', 'family')
            ->select('families.family_name', 'users.name as head_name', DB::raw('COUNT(*) as count'), DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(amount) as total_amount'))
            ->join('families', 'relief_distributions.family_id', '=', 'families.id')
            ->join('users', 'relief_distributions.head_of_family_id', '=', 'users.id')
            ->groupBy('families.id', 'families.family_name', 'users.name')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        // Top Recipients
        $topRecipients = (clone $query)
            ->select('users.name', 'users.email', DB::raw('COUNT(*) as count'), DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(amount) as total_amount'))
            ->join('users', 'relief_distributions.user_id', '=', 'users.id')
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        // Daily Statistics
        $dailyStats = (clone $query)
            ->selectRaw("DATE(distributed_at) as date, COUNT(*) as count, SUM(quantity) as total_quantity, SUM(amount) as total_amount")
            ->groupBy(DB::raw("DATE(distributed_at)"))
            ->orderBy('date', 'asc')
            ->get();

        // Monthly Statistics
        $monthlyStats = (clone $query)
            ->selectRaw("DATE_FORMAT(distributed_at, '%Y-%m') as month, COUNT(*) as count, SUM(quantity) as total_quantity, SUM(amount) as total_amount")
            ->groupBy(DB::raw("DATE_FORMAT(distributed_at, '%Y-%m')"))
            ->orderBy('month', 'asc')
            ->get();

        $operations = ReliefOperation::orderBy('title')->get();
        $types = ReliefType::orderBy('name')->get();

        return view('livewire.relief-operation.report', [
            'totalDistributions' => $totalDistributions,
            'totalRecipients' => $totalRecipients,
            'totalQuantity' => $totalQuantity,
            'totalAmount' => $totalAmount,
            'byOperation' => $byOperation,
            'byType' => $byType,
            'byProvider' => $byProvider,
            'byDistributionType' => $byDistributionType,
            'familyDistributions' => $familyDistributions,
            'topRecipients' => $topRecipients,
            'dailyStats' => $dailyStats,
            'monthlyStats' => $monthlyStats,
            'operations' => $operations,
            'types' => $types,
        ]);
    }
}

