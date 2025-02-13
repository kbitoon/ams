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
    public string $title = '';
    public string $nature = '';
    public string $complaint = '';
    public string $prayer = '';
    public string $status = '';
    public int|string $blotter_id = '';
    public string $end = '';
    public array $resolution_form = [];


    /**
     * @param LuponCase|null $luponCase
     */
    public function setLuponCase(?LuponCase $luponCase = null): void
    {
        $this->luponCase = $luponCase;
        $this->date = $luponCase->date;
        $this->case_no = $luponCase->case_no;
        $this->title = empty($luponCase->title) ? '': $luponCase->title;
        $this->nature = empty($luponCase->nature) ? '': $luponCase->nature;
        $this->complaint = $luponCase->complaint;
        $this->prayer = $luponCase->prayer;
        $this->status = $luponCase->status;
        $this->blotter_id = empty($luponCase->blotter_id) ? '': $luponCase->blotter_id;
        $this->end = empty($luponCase->end) ? '': $luponCase->end;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'date' => ['required', 'date_format:Y-m-d'],
            'case_no' => ['nullable'],
            'title' => ['nullable'],
            'nature' => ['nullable'],
            'complaint' => ['required'],
            'prayer' => ['required'],
            'status' => ['required'],
            'blotter_id' => ['nullable', 'integer'],
            'end' => ['nullable', 'date_format:Y-m-d'],
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
            'title' => 'title',
            'nature' => 'nature',
            'complaint' => 'complaint',
            'prayer' => 'prayer',
            'status' => 'status',
            'blotter_id' => 'blotter_id',
            'end' => 'end',
            'resolution_form' => 'resolution_form',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        // Ensure blotter_id is properly handled if it's empty
        $data = $this->only(['date', 'case_no','title','nature', 'complaint', 'prayer', 'status', 'blotter_id','end']);
        $data['blotter_id'] = $this->blotter_id ?: null;
        $data['end'] = empty($this->end) ? null : $this->end;

        if (!$this->luponCase) {
            $this->luponCase = LuponCase::create($data);
        } else {
            $this->luponCase->update($data);
        }

        // Handle file uploads
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
