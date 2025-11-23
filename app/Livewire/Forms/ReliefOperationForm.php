<?php

namespace App\Livewire\Forms;

use App\Models\ReliefOperation;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ReliefOperationForm extends Form
{
    public ?ReliefOperation $reliefOperation = null;

    public string $title = '';
    public string $description = '';
    public string $purpose = '';
    public string $operation_date = '';
    public string $status = 'active';
    public bool $is_per_family = false;
    public string $provider_id = '';

    public function setReliefOperation(?ReliefOperation $reliefOperation = null): void
    {
        $this->reliefOperation = $reliefOperation;
        $this->title = $reliefOperation->title ?? '';
        $this->description = $reliefOperation->description ?? '';
        $this->purpose = $reliefOperation->purpose ?? '';
        $this->operation_date = $reliefOperation->operation_date?->format('Y-m-d') ?? '';
        $this->status = $reliefOperation->status ?? 'active';
        $this->is_per_family = $reliefOperation->is_per_family ?? false;
        $this->provider_id = $reliefOperation->provider_id ?? '';
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'purpose' => ['nullable', 'string', 'max:255'],
            'operation_date' => ['required', 'date'],
            'status' => ['required', 'in:active,completed,cancelled'],
            'is_per_family' => ['boolean'],
            'provider_id' => ['nullable', 'exists:relief_providers,id'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'title' => 'title',
            'operation_date' => 'operation date',
            'status' => 'status',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        $data = $this->only(['title', 'description', 'purpose', 'operation_date', 'status', 'is_per_family', 'provider_id']);
        
        if (!$this->reliefOperation) {
            $data['created_by'] = auth()->id();
            ReliefOperation::create($data);
        } else {
            $this->reliefOperation->update($data);
        }

        $this->reset();
    }
}

