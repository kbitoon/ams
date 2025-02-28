<?php

namespace App\Livewire\Modals\Show;

use App\Models\LuponCase;
use App\Models\LuponHearingTracking;
use App\Models\LuponSummonTracking;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;

class LuponCaseModal extends ModalComponent
{
    public ?LuponCase $luponCase = null;

    protected $listeners = ['refresh-list' => '$refresh'];

    public function mount(LuponCase $luponCase = null): void
    {
         if ($luponCase && $luponCase->exists) {
            $this->luponCase = $luponCase->load('luponCaseComments.user', 'luponCaseComplainants', 'luponCaseRespondents',
                                                'luponSummonTrackings', 'luponHearingTrackings');
        }
    }
    public function deleteAttachment($attachmentId)
    {
        $attachment = $this->luponCase->assets()->find($attachmentId);

        if ($attachment) {
            Storage::delete($attachment->path);


            $attachment->delete();

            $this->luponCase = $this->luponCase->refresh();

            $this->dispatch('attachmentDeleted');
        }
    }

    public function deleteHearing($id)
    {
        $hearingTracking = LuponHearingTracking::find($id);
    
        if ($hearingTracking) {
            // Delete related assets first
            if (method_exists($hearingTracking, 'assets')) {
                foreach ($hearingTracking->assets as $asset) {
                    // Delete the file from storage
                    \Storage::delete($asset->path);
                    
                    // Delete the asset record from the database
                    $asset->delete();
                }
            }
    
            // Delete the main hearing tracking record
            $hearingTracking->delete();
    
            // Dispatch event to refresh the list
            $this->dispatch('refresh-list');
        }
    }

    public function deleteSummon($id)
    {
        $summonTracking = LuponSummonTracking::find($id);

        if ($summonTracking) {
            $summonTracking->delete();
            $this->dispatch('refresh-list');
        }
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.lupon-case.view', [
            'luponCase' => $this->luponCase,
            'luponSummonTrackings' => $this->luponCase->luponSummonTrackings ?? [],
            'luponHearingTrackings' => $this->luponCase->luponHearingTrackings ?? [],
            'luponCaseComplainants' => $this->luponCase->luponCaseComplainants ?? [],
            'luponCaseRespondents' => $this->luponCase->luponCaseRespondents ?? [],
            'luponCaseComments' => $this->luponCase->luponCaseComments ?? [],
        ]);
    }
}
