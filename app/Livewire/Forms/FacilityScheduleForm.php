<?php

namespace App\Livewire\Forms;

use App\Models\FacilitySchedule;
use App\Models\Facility;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class FacilityScheduleForm extends Form
{
    public ?FacilitySchedule $facilitySchedule = null;

    public string $facility_id = '';
    public string $name = '';
    public string $start = '';
    public string $end = '';
    public string $purpose = '';
    public string $status = ''; 
    public string $is_approved = '';

    /**
     * @param FacilitySchedule|null $facilitySchedule
     */
    public function setFacilitySchedule(?FacilitySchedule $facilitySchedule = null): void
    {
        $this->facilitySchedule = $facilitySchedule;
        $this->facility_id = $facilitySchedule->facility_id;
        $this->start = $facilitySchedule->start;
        $this->end = $facilitySchedule->end;
        $this->name = $facilitySchedule->name;
        $this->purpose = $facilitySchedule->purpose;
        $this->status = $facilitySchedule->status;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'facility_id' => ['required'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date', 'after:start'],
            'name' => ['required'],
            'purpose' => ['required'],
        ];
    }
   
    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'facility_id' => 'facility',
            'start' => 'start',
            'end' => 'end',
            'name' => 'name',
            'purpose' => 'purpose',
            'status' => 'status',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {

        $this->validate();

         // Determine the role of the user
         $userRole = auth()->user()->getRoleNames()->first();
         $isAdminRole = in_array($userRole, ['administrator', 'superadmin', 'support']);
 
         // Automatically set is_approved
         $this->is_approved = $isAdminRole ? '1' : '0';
 
         $data = $this->only(['facility_id', 'start', 'end',  'name','purpose', 'status','is_approved']);
         $data['user_id'] = auth()->user()->id;

         if (!$this->facilitySchedule) {
            FacilitySchedule::create($data);
        } else {
            $this->facilitySchedule->update($data);
        }
        
        $this->reset();
    }
}
