<?php

namespace App\Livewire\Forms;

use App\Models\LuponCase;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class LuponCaseForm extends Form
{
    public ?LuponCase $luponCase = null;

    public string $date = '';
    public string $case_no = '';
    public string $complaint = '';
    public string $prayer = '';
    public string $status = '';
    public int|string $blotter_id = '';
    public array $resolution_form = [];


    /**
     * @param LuponCase|null $luponCase
     */
    public function setLuponCase(?LuponCase $luponCase = null): void
    {
        $this->luponCase = $luponCase;
        $this->date = $luponCase->date;
        $this->case_no = $luponCase->case_no;
        $this->complaint = $luponCase->complaint;
        $this->prayer = $luponCase->prayer;
        $this->status = $luponCase->status;
        $this->blotter_id = $luponCase->blotter_id;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'date' => ['required', 'date_format:Y-m-d'],
            'case_no' => ['nullable'],
            'complaint' => ['required'],
            'prayer' => ['required'],
            'status' => ['required'],
            'blotter_id' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'date' => 'date',
            'case_no' => 'case_no',
            'complaint' => 'complaint',
            'prayer' => 'prayer',
            'status' => 'status',
            'blotter_id' => 'blotter_id',
            'resolution_form' => 'resolution_form',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->luponCase) {
                $this->luponCase = LuponCase::create($this->only(['date', 'case_no', 'complaint', 'prayer', 'status', 'blotter_id']));
        } else {
            $this->luponCase->update($this->only(['date', 'case_no', 'complaint', 'prayer', 'status', 'blotter_id']));

        }

        // handle file uploads, possible convert this to traits to be re-used on other entities
        foreach ($this->resolution_form as $resolution_form) {
            $id = auth()->id() ?? 1;
            $path = $resolution_form->storePubliclyAs('resolution_forms/' . $id, time() . '-' . $resolution_form->getClientOriginalName());
            $this->luponCase->assets()->create([
                'path' => $path,
            ]);
        }

        $this->reset();
    }

}
