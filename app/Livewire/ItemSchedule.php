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
         // Filter and sort the data
         $itemSchedules = auth()->user()->hasRole('superadmin|administrator') 
         ? ItemScheduleModel::orderBy('start', 'asc')->paginate(10) 
         : ItemScheduleModel::where('user_id', auth()->user()->id)->orderBy('start', 'asc')->paginate(10);

         foreach ($itemSchedules as $schedule) {
             $schedule->formatted_start = Carbon::parse($schedule->start)->format('M. j,  g:iA');
             $schedule->formatted_end = Carbon::parse($schedule->end)->format('M. j,  g:iA');
         }

     return view('livewire.item.schedule', [
         'itemSchedules' => $itemSchedules,
     ]);
    }
}
