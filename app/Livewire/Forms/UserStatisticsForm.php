<?php

namespace App\Livewire\Forms;

use App\Models\UserStatistics;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class UserStatisticsForm extends Form
{
    public ?UserStatistics $userStatistics = null;

    public string $first_name = '';
    public string $last_name = '';
    public int $age = 0;
    public string $group = '';

    /**
     * @param UserStatistics|null $userStatistics
     */
    public function setUserStatistics(?UserStatistics $userStatistics = null): void
    {
        $this->userStatistics = $userStatistics;
        $this->first_name = $userStatistics->first_name;
        $this->last_name = $userStatistics->last_name;
        $this->age = $userStatistics->age;
        $this->group = $userStatistics->group;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'age' => ['required'],
            'group' => ['nullable'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'amount' => 'amount',
            'group' => 'group',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->userStatistics) {
            UserStatistics::create($this->only(['first_name', 'last_name','age', 'group']));
        } else {
            $this->userStatistics->update($this->only(['first_name', 'last_name','age', 'group']));
        }
        $this->reset();
    }
}
