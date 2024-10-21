<?php

namespace App\Livewire;

use App\Models\BarangayList as BarangayListModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class BarangayList extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    public function delete($id)
    {
        // Find the clearance type by id and delete it
        $barangayList = BarangayListModel::findOrFail($id);
        $barangayList->delete();

        // Refresh the component to update the list
        $this->dispatch('refresh-list');
    }

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('livewire.campaign-iq.barangay-list', [
            'barangayLists' => BarangayListModel::paginate(10),
        ]);
    }
}
