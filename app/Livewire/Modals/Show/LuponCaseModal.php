<?php

namespace App\Livewire\Modals\Show;

use App\Models\LuponCase;
use App\Models\LuponCaseComplainant;
use App\Models\LuponCaseRespondent;
use App\Models\LuponHearingTracking;
use App\Models\LuponSummonTracking;
use App\Models\Asset;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class LuponCaseModal extends ModalComponent
{
    use WithFileUploads;

    public ?LuponCase $luponCase = null;

    /** @var array New attachments to upload (multiple files) */
    public array $newAttachments = [];

    protected $listeners = ['refresh-list' => '$refresh'];

    public static function modalMaxWidth(): string
    {
        return '4xl'; // Wider (≈33%) than default 2xl for easier reading
    }

    public function mount(LuponCase $luponCase = null): void
    {
         if ($luponCase && $luponCase->exists) {
            $this->luponCase = $luponCase->load('luponCaseComments.user', 'luponCaseComplainants', 'luponCaseRespondents',
                'luponSummonTrackings', 'luponHearingTrackings.assets', 'assets');
        }
    }
    /**
     * Upload and save additional attachments to the case.
     */
    public function uploadNewAttachments(): void
    {
        $files = is_array($this->newAttachments) ? $this->newAttachments : [];
        if (!empty($this->newAttachments) && $this->newAttachments instanceof \Illuminate\Http\UploadedFile) {
            $files = [$this->newAttachments];
        }

        $userId = auth()->id() ?? 1;
        foreach ($files as $index => $file) {
            if (!$file instanceof \Illuminate\Http\UploadedFile) {
                continue;
            }
            $filename = $file->getClientOriginalName();
            $uniqueName = (string) (time() + $index) . '-' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
            $path = $file->storePubliclyAs('resolution_forms/' . $userId, $uniqueName);
            $this->luponCase->assets()->create(['path' => $path]);
        }

        $this->newAttachments = [];
        $this->luponCase = $this->luponCase->fresh(['assets']);
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

    public function deleteHearingAttachment($attachmentId): void
    {
        // Find the attachment by ID and ensure it belongs to a hearing tracking
        $attachment = Asset::find($attachmentId);

        if ($attachment && $attachment->assetable instanceof LuponHearingTracking) {
            Storage::delete($attachment->path);
            $attachment->delete();

            // Refresh the case with hearing attachments so UI updates
            $this->luponCase = $this->luponCase->fresh(['luponHearingTrackings.assets']);
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
