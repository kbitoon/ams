<?php

namespace App\Livewire\Forms;

use App\Models\LuponHearingTracking;
use App\Models\LuponCase;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class LuponHearingTrackingForm extends Form
{
    public ?LuponHearingTracking $luponHearingTracking = null;

    public string $date_time = '';
    public string $received_by = '';
    public string $served_by = '';
    public string $remarks = '';
    public string $lupon_case_id = '';
    /**
     * @param LuponHearingTracking|null $luponHearingTracking
     */
    public function setLuponHearingTracking(?LuponHearingTracking $luponHearingTracking= null): void
    {
        $this->luponHearingTracking = $luponHearingTracking;
        $this->date_time = $luponHearingTracking->date_time;
        $this->received_by = $luponHearingTracking->received_by;
        $this->served_by = $luponHearingTracking->served_by;
        $this->remarks = $luponHearingTracking->remarks;
        $this->lupon_case_id = $luponHearingTracking->lupon_case_id;
        
    }
    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'date_time' => ['required'],
            'received_by' => ['required'],
            'served_by' => ['required'],
            'remarks' => ['required','numeric'],
            'lupon_case_id' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'date_time' => 'date_time',
            'received_by' => 'received_by',
            'served_by' => 'served_by',
            'remarks' => 'remarks',
            'lupon_case_id' => 'lupon_case_id',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {

        $this->validate();

        if (!$this->luponHearingTracking) {
            LuponHearingTracking::create($this->only(['date_time', 'received_by', 'served_by',  'remarks', 'lupon_case_id']));
        } else {
            $this->luponHearingTracking->update($this->only(['date_time', 'received_by', 'served_by',  'remarks', 'lupon_case_id']));
        }
        
        $this->reset();
    }
}
