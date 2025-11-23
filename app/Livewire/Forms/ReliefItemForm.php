<?php

namespace App\Livewire\Forms;

use App\Models\ReliefItem;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ReliefItemForm extends Form
{
    public ?ReliefItem $reliefItem = null;

    public string $relief_operation_id = '';
    public string $relief_type_id = '';
    public string $provider_id = '';
    public string $quantity_received = '';
    public string $unit_cost = '';
    public string $notes = '';

    public function setReliefItem(?ReliefItem $reliefItem = null): void
    {
        $this->reliefItem = $reliefItem;
        $this->relief_operation_id = $reliefItem->relief_operation_id ?? '';
        $this->relief_type_id = $reliefItem->relief_type_id ?? '';
        $this->provider_id = $reliefItem->provider_id ?? '';
        $this->quantity_received = $reliefItem->quantity_received ?? '';
        $this->unit_cost = $reliefItem->unit_cost ?? '';
        $this->notes = $reliefItem->notes ?? '';
    }

    public function rules(): array
    {
        return [
            'relief_operation_id' => ['required', 'exists:relief_operations,id'],
            'relief_type_id' => ['required', 'exists:relief_types,id'],
            'provider_id' => ['nullable', 'exists:relief_providers,id'],
            'quantity_received' => ['required', 'numeric', 'min:0.01'],
            'unit_cost' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'relief_operation_id' => 'relief operation',
            'relief_type_id' => 'relief type',
            'quantity_received' => 'quantity received',
            'unit_cost' => 'unit cost',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        $data = $this->only([
            'relief_operation_id',
            'relief_type_id',
            'provider_id',
            'quantity_received',
            'unit_cost',
            'notes',
        ]);

        // Convert empty strings to null for nullable fields
        $data['provider_id'] = $data['provider_id'] === '' ? null : $data['provider_id'];
        $data['unit_cost'] = $data['unit_cost'] === '' ? null : ($data['unit_cost'] ? (float) $data['unit_cost'] : null);
        $data['notes'] = $data['notes'] === '' ? null : $data['notes'];

        if (!$this->reliefItem) {
            ReliefItem::create($data);
        } else {
            $this->reliefItem->update($data);
        }

        $this->reset();
    }
}

