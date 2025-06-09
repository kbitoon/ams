<?php

namespace App\Livewire\Forms;

use App\Models\LuponCase;
use App\Models\LuponEventTracking;
use App\Models\Blotter;
use App\Models\LuponCaseComplainant;
use App\Models\LuponCaseRespondent;
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
    public array $resolution_forms = [];
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
            'resolution_forms' => 'resolution_form',
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

         // Get the last case ID for case_no generation
        $latestCase = LuponCase::latest('id')->first();
        $lastId = $latestCase ? $latestCase->id : 0;

        // Check if it's an update (edit) or create
        $isUpdate = $this->luponCase ? true : false;

    
        if (!$this->luponCase) {
            $this->luponCase = LuponCase::create($data);
            
        } else {
           
            $this->luponCase->update($data);

            // Track the event if it's an update (edit)
            if ($isUpdate) {
                LuponEventTracking::create([
                    'user_id' => auth()->id() ?? 1, // Replace with actual user ID logic
                    'lupon_case_id' => $this->luponCase->id,
                    'event_description' => 'Updated Case No: ' . $data['case_no'],
                ]);
            }
        }

        // If there's a blotter_id, fetch complainant and respondents
        if (!empty($this->blotter_id)) {
            $blotter = Blotter::with('complainee')->find($this->blotter_id);
            
            if ($blotter) {
                // Save the complainant details to `lupon_cases_complainants`
                LuponCaseComplainant::updateOrCreate(
                    ['lupon_case_id' => $this->luponCase->id], // Match by LuponCase ID
                    [
                        'firstname'      => $blotter->firstname,
                        'middlename'     => $blotter->middle,
                        'lastname'       => $blotter->lastname,
                        'contact_number' => $blotter->contact,
                        'address'        => $blotter->address,
                    ]
                );

                // Save the respondent details to `lupon_cases_respondents`
                if ($blotter->complainee) {
                    LuponCaseRespondent::updateOrCreate(
                        ['lupon_case_id' => $this->luponCase->id], // Match by LuponCase ID
                        [
                            'firstname'      => $blotter->complainee->first,
                            'middlename'     => $blotter->complainee->middle,
                            'lastname'       => $blotter->complainee->last,
                            'contact_number' => $blotter->complainee->contact,
                            'address'        => $blotter->complainee->address,
                        ]
                    );
                }
            }
        }
        // Handle file uploads
        foreach ($this->resolution_forms as $resolution_form) {
            if ($resolution_form instanceof \Illuminate\Http\UploadedFile) {
                $id = auth()->id() ?? 1;
                $path = $resolution_form->storePubliclyAs('resolution_forms/' . $id, time() . '-' . $resolution_form->getClientOriginalName());
                $this->luponCase->assets()->create([
                    'path' => $path,
                ]);
            } else {
                // Handle invalid file type or data here
                throw new \Exception('Invalid file data.');
            }
        }

        $this->reset();
    }

}
