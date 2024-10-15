<?php

namespace App\Livewire;

use App\Models\ItemSchedule as ItemScheduleModel;
use App\Models\Item;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Carbon\Carbon;

class ItemSchedule extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $dateFilter;
    public $itemFilter;
    public $statusFilter;

    public $tempDateFilter;
    public $tempItemFilter;
    public $tempStatusFilter;

    #[On('refresh-list')]
    public function refresh() {}

    public function applyFilters()
    {
        $this->dateFilter = $this->tempDateFilter;
        $this->itemFilter = $this->tempItemFilter;
        $this->statusFilter = $this->tempStatusFilter;

        // Reset the page number to 1
        $this->resetPage();
    }

    public function updateStatus($scheduleId, $newStatus): void
    {
        $schedule = ItemScheduleModel::findOrFail($scheduleId);
        $item = $schedule->item;

        $originalStatus = $schedule->status;

        if ($originalStatus === 'Ongoing' && $newStatus === 'Done') {
            $item->QuantityLeft += $schedule->quantity;
        } elseif ($originalStatus !== 'Ongoing' && $newStatus === 'Ongoing') {
            $item->QuantityLeft -= $schedule->quantity;
        }

        $schedule->status = $newStatus;
        $schedule->save();
        $item->save();

        $this->refresh();
    }                   

    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $query = ItemScheduleModel::query();

        if (auth()->user()->hasRole('superadmin|administrator')) {
            if ($this->dateFilter) {
                $query->whereDate('start', $this->dateFilter);
            }
            if ($this->itemFilter) {
                $query->where('item_id', $this->itemFilter);
            }
            if ($this->statusFilter) {
                $query->where('status', $this->statusFilter);
            }
        } else {
            $query->where('user_id', auth()->user()->id);
            if ($this->dateFilter) {
                $query->whereDate('start', $this->dateFilter);
            }
            if ($this->itemFilter) {
                $query->where('item_id', $this->itemFilter);
            }
            if ($this->statusFilter) {
                $query->where('status', $this->statusFilter);
            }
        }

        $itemSchedules = $query->orderBy('start', 'desc')->paginate(10);

        foreach ($itemSchedules as $schedule) {
            $schedule->formatted_start = Carbon::parse($schedule->start)->format('M. j,  g:iA');
            $schedule->formatted_end = Carbon::parse($schedule->end)->format('M. j,  g:iA');
        }

        $items = Item::all(); // Fetch items for dropdown

        return view('livewire.item.schedule', [
            'itemSchedules' => $itemSchedules,
            'items' => $items, // Pass items for dropdown filter
        ]);
    }
}
