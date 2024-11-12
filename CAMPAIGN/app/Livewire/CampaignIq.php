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
    protected $updatesQueryString = ['search', 'filter','sortField', 'sortDirection'];
    public int $totalBarangayCaptains = 0;
    public int $totalBarangays = 0;
    public $sortField = 'familyname';
    public $sortDirection = 'asc';

    #[On('refresh-list')]
    public function refresh() {}

    public function searchItems()
    {
        $this->resetPage(); 

    }

    public function delete($id)
    {
        $campaignIq = CampaignIqModel::findOrFail($id);
        $campaignIq->delete();

        $this->dispatch('refresh-list');
    }
    public function markAsPaid($id)
    {
        $campaignIq = CampaignIqModel::findOrFail($id);
        if ($campaignIq && auth()->check()) { 
            $campaignIq->status = 'Paid';
            $campaignIq->save();
        }
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
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

        $query->orderBy($this->sortField, $this->sortDirection);

        $totalSupporter = CampaignIqModel::count();
        $totalLeaders = CampaignIqModel::where('designation', 'Leader')->count();
        $totalCoordinators = CampaignIqModel::where('designation', 'Coordinator')->count();
        $this->totalBarangayCaptains = CampaignIqModel::where('government_position', 'Barangay Captain')->count();
        $this->totalBarangays = CampaignIqModel::distinct('barangay')->count('barangay');

        $campaignIqs = $query->paginate(10);
        $barangays = CampaignIqModel::select('barangay')->distinct()->pluck('barangay');
        
        return view('livewire.campaign.listing', [
            'campaignIqs'=>$campaignIqs,
            'barangays' => $barangays,
            'totalSupporter' => $totalSupporter,
            'totalLeaders' => $totalLeaders,
            'totalCoordinators' => $totalCoordinators,
            'totalBarangayCaptains' => $this->totalBarangayCaptains,
            'totalBarangays' => $this->totalBarangays,
        ]);
    }
}
