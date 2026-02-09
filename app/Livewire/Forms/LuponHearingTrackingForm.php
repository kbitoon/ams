<?php

namespace App\Livewire\Forms;

use App\Models\LuponHearingTracking;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use Livewire\WithFileUploads;

class LuponHearingTrackingForm extends Form
{
    use WithFileUploads;
    public ?LuponHearingTracking $luponHearingTracking = null;

    public string $date_time = '';
    public string $type = '';
    public string $remarks = '';
    public string $lupon_case_id = '';
    public string $secretary = '';
    public string $presider = '';

    public array $attachments = [];
    /**
     * @param LuponHearingTracking|null $luponHearingTracking
     */
    public function setLuponHearingTracking(?LuponHearingTracking $luponHearingTracking= null): void
    {
        $this->luponHearingTracking = $luponHearingTracking;
        $this->date_time = $luponHearingTracking->date_time;
        $this->type = $luponHearingTracking->type;
        $this->remarks = $luponHearingTracking->remarks;
        $this->secretary = empty($luponHearingTracking->secretary) ? '' : $luponHearingTracking->secretary;
        $this->presider = empty($luponHearingTracking->presider) ? '' : $luponHearingTracking->presider;
        $this->lupon_case_id = $luponHearingTracking->lupon_case_id;
        
    }

    public function setLuponCaseId($luponCaseId): void
    {
        $this->lupon_case_id = $luponCaseId;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'date_time' => ['required'],
            'type' => ['required'],
            'remarks' => ['required'],
            'lupon_case_id' => ['required'],
            'secretary' => ['nullable'],
            'presider' => ['nullable'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:10240'], // 10MB per file
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'date_time' => 'date_time',
            'type' => 'type',
            'remarks' => 'remarks',
            'secretary' => 'secretary',
            'presider' => 'presider',
            'lupon_case_id' => 'lupon_case_id',
            'attachments' => 'attachment',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
    
        if (!$this->luponHearingTracking) {
            $this->luponHearingTracking = LuponHearingTracking::create($this->only(['date_time', 'type', 'remarks', 'secretary', 'presider', 'lupon_case_id']));
        } else {
            $this->luponHearingTracking->update($this->only(['date_time', 'type', 'remarks', 'secretary', 'presider', 'lupon_case_id']));
        }
    
        // 🔹 Ensure the instance is fresh from the database
        $this->luponHearingTracking = LuponHearingTracking::find($this->luponHearingTracking->id);
    
        // 🔹 Debugging: Check if the model exists
        if (!$this->luponHearingTracking) {
            throw new \Exception("LuponHearingTracking instance is null after saving.");
        }
    
        // Handle multiple file uploads (normalize to array, process each valid file)
        $files = is_array($this->attachments) ? $this->attachments : [];
        foreach ($files as $index => $file) {
            if (!$file instanceof \Illuminate\Http\UploadedFile) {
                continue;
            }
            if (!method_exists($this->luponHearingTracking, 'assets')) {
                continue;
            }
            $userId = auth()->id() ?? 1;
            $filename = $file->getClientOriginalName();
            $uniqueName = (string) (time() + $index) . '-' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
            $path = $file->storePubliclyAs('attachments/' . $userId, $uniqueName);
            $this->luponHearingTracking->assets()->create(['path' => $path]);
        }

        $this->reset();
    }
}    
