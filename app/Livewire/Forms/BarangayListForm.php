<?php

namespace App\Livewire\Forms;

use App\Models\BarangayList;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class BarangayListForm extends Form
{
    public ?BarangayList $barangayList = null;

    public string $barangay = '';
    public string $district = '';

    /**
     * @param BarangayList|null $barangayList
     */
    public function setAnnouncement(?BarangayList $barangayList = null): void
    {
        $this->barangayList = $barangayList;
        $this->barangay = $barangayList->barangay;
        $this->district = $barangayList->district;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'barangay' => ['required'],
            'district' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'barangay' => 'barangay',
            'district' => 'district',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->barangayList) {
            $barangayList = BarangayList::create($this->only(['barangay', 'district']));
        } else {
            $this->barangayList->update($this->only(['barangay', 'district']));
        }
        $this->reset();
    }
}
