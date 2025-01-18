<?php

namespace App\Livewire\Forms;

use App\Models\LuponSummonTracking;
use App\Models\LuponCase;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class LuponSummonTrackingForm extends Form
{
    public ?LuponSummonTracking $luponSummonTracking = null;

    public string $date_time = '';
    public string $received_by = '';
    public string $served_by = '';
    public string $remarks = '';
    public string $lupon_case_id = '';
    /**
     * @param LuponSummonTracking|null $luponSummonTracking
     */
    public function setLuponSummonTracking(?LuponSummonTracking $luponSummonTracking= null): void
    {
        $this->luponSummonTracking = $luponSummonTracking;
        $this->date_time = $luponSummonTracking->date_time;
        $this->received_by = $luponSummonTracking->received_by;
        $this->served_by = $luponSummonTracking->served_by;
        $this->remarks = $luponSummonTracking->remarks;
        $this->lupon_case_id = $luponSummonTracking->lupon_case_id;
        
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

        if (!$this->luponSummonTracking) {
            LuponSummonTracking::create($this->only(['date_time', 'received_by', 'served_by',  'remarks', 'lupon_case_id']));
        } else {
            $this->luponSummonTracking->update($this->only(['date_time', 'received_by', 'served_by',  'remarks', 'lupon_case_id']));
        }
        
        $this->reset();
    }
}
