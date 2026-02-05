<?php

namespace App\Livewire\Modals\Show;

use App\Models\LuponCase;
use App\Models\LuponCaseComplainant;
use App\Models\LuponCaseRespondent;
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

    public static function modalMaxWidth(): string
    {
        return '4xl'; // Wider (≈33%) than default 2xl for easier reading
    }

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

    public function deleteComplainant($id)
    {
        $complainant = LuponCaseComplainant::find($id);

        if ($complainant && $complainant->lupon_case_id === $this->luponCase->id) {
            foreach ($complainant->assets as $asset) {
                Storage::delete($asset->path);
                $asset->delete();
            }
            $complainant->delete();
            $this->luponCase = $this->luponCase->fresh(['luponCaseComplainants', 'luponCaseRespondents']);
            $this->dispatch('refresh-list');
        }
    }

    public function deleteRespondent($id)
    {
        $respondent = LuponCaseRespondent::find($id);

        if ($respondent && $respondent->lupon_case_id === $this->luponCase->id) {
            foreach ($respondent->assets as $asset) {
                Storage::delete($asset->path);
                $asset->delete();
            }
            $respondent->delete();
            $this->luponCase = $this->luponCase->fresh(['luponCaseComplainants', 'luponCaseRespondents']);
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
