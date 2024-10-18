<?php

namespace App\Livewire\Forms;

use App\Models\UserStatistics;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class UserStatisticsForm extends Form
{
    public ?UserStatistics $userStatistics = null;

    public int $total = 0;
    public string $group = '';

    /**
     * @param UserStatistics|null $userStatistics
     */
    public function setUserStatistics(?UserStatistics $userStatistics = null): void
    {
        $this->userStatistics = $userStatistics;
        $this->total = $userStatistics->total;
        $this->group = $userStatistics->group;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'total' => ['required'],
            'group' => ['nullable'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'total' => 'total',
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
            UserStatistics::create($this->only(['total', 'group']));
        } else {
            $this->userStatistics->update($this->only(['total', 'group']));
        }
        $this->reset();
    }
}
