<?php

namespace App\Livewire;

use App\Models\CampaignIq as CampaignIqModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class CampaignIq extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $filter = '';
    protected $listeners = ['refresh-list' => 'refresh'];
    protected $updatesQueryString = ['search', 'filter'];

    #[On('refresh-list')]
    public function refresh() {}

    public function searchItems()
    {
        $this->resetPage(); 

    }


    public function delete($id)
    {
        $clearanceType = CampaignIqModel::findOrFail($id);
        $clearanceType->delete();

        $this->dispatch('refresh-list');
    }

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {

        $query = CampaignIqModel::query();

        if ($this->search) {
            $query->where('firstname', 'like', '%' . $this->search . '%')
                  ->orWhere('familyname', 'like', '%' . $this->search . '%')
                  ->orWhere('designation', 'like', '%' . $this->search . '%');
        }
        if ($this->filter) {
            $query->where('barangay', $this->filter);
        }

        $campaignIqs = $query->paginate(10);
        $barangays = CampaignIqModel::select('barangay')->distinct()->pluck('barangay');
        
        return view('livewire.campaign-iq.listing', [
            'campaignIqs'=>$campaignIqs,
            'barangays' => $barangays,
        ]);
    }
}
