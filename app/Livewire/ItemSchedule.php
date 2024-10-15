<?php

namespace App\Livewire;

use App\Models\ItemSchedule as ItemScheduleModel;
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

    #[On('refresh-list')]
    public function refresh() {}

    public function updateStatus($scheduleId, $newStatus): void
    {
        $schedule = ItemScheduleModel::findOrFail($scheduleId);
        $item = $schedule->item;

        // Check the original status
        $originalStatus = $schedule->status;

        // Adjust quantities based on status changes
        if ($originalStatus === 'Ongoing' && $newStatus === 'Done') {
            // Status changed from ongoing to done
            $item->QuantityLeft += $schedule->quantity;
        } elseif ($originalStatus !== 'Ongoing' && $newStatus === 'Ongoing') {
            // Status changed to ongoing
            $item->QuantityLeft -= $schedule->quantity;
        }

        // Update the status
        $schedule->status = $newStatus;
        $schedule->save();
        $item->save();

        // Refresh the component
        $this->refresh();
    }                   
    /**
     * @return  Application|View|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Get today's date
        $today = Carbon::today();
    
        // Query all schedules and prioritize those that are not 'Done'
        $itemSchedules = auth()->user()->hasRole('superadmin|administrator')
            ? ItemScheduleModel::where(function($query) use ($today) {
                $query->where('status', '!=', 'Done')
                      ->where('start', '>=', $today); // Not done and start today or future
            })
            ->orWhere(function($query) use ($today) {
                $query->where('status', 'Done')
                      ->orWhere('start', '<', $today); // Done or past schedules
            })
            ->orderByRaw("FIELD(status, 'Ongoing', 'Pending', 'Done')") // Prioritize based on status
            ->orderBy('start', 'asc') // Sort by start date (upcoming first)
            ->paginate(10)
    
            : ItemScheduleModel::where('user_id', auth()->user()->id)
            ->where(function($query) use ($today) {
                $query->where('status', '!=', 'Done')
                      ->where('start', '>=', $today); 
            })
            ->orWhere(function($query) use ($today) {
                $query->where('status', 'Done')
                      ->orWhere('start', '<', $today); 
            })
            ->orderByRaw("FIELD(status, 'Ongoing', 'Pending', 'Done')")
            ->orderBy('start', 'asc')
            ->paginate(10);
    
        // Format the start and end dates for display
        foreach ($itemSchedules as $schedule) {
            $schedule->formatted_start = Carbon::parse($schedule->start)->format('M. j, g:iA');
            $schedule->formatted_end = Carbon::parse($schedule->end)->format('M. j, g:iA');
        }
    
        return view('livewire.item.schedule', [
            'itemSchedules' => $itemSchedules,
        ]);
    }
    
}
