<?php

namespace App\Livewire\Modals\Show;

use App\Models\LuponEventTracking as LuponEventTrackingModel;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithPagination;
use Livewire\Features\SupportPagination\WithoutUrlPagination;

class LuponEventTrackingModal extends ModalComponent
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    public function render()
    {
        $luponEventTrackings = LuponEventTrackingModel::orderBy('created_at', 'desc')->paginate(5);

        return view('livewire.lupon-case.event', [
            'luponEventTrackings' => $luponEventTrackings,
        ]);
    }
}
