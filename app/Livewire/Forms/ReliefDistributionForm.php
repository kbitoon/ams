<?php

namespace App\Livewire\Forms;

use App\Models\ReliefDistribution;
use App\Models\ReliefItem;
use App\Models\ReliefOperation;
use App\Models\Family;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ReliefDistributionForm extends Form
{
    public ?ReliefDistribution $reliefDistribution = null;

    public string $relief_operation_id = '';
    public string $relief_item_id = '';
    public string $distribution_type = 'individual'; // 'individual' or 'family'
    public string $user_id = ''; // Individual recipient OR representative
    public string $family_id = ''; // Family (if distribution_type = 'family')
    public string $head_of_family_id = ''; // Head of family (auto-set when family is selected)
    public string $quantity = '';
    public string $amount = '';
    public string $purpose = '';
    public string $notes = '';
    public string $distributed_at = '';

    public function setReliefDistribution(?ReliefDistribution $reliefDistribution = null): void
    {
        $this->reliefDistribution = $reliefDistribution;
        $this->relief_operation_id = $reliefDistribution->relief_operation_id ?? '';
        $this->relief_item_id = $reliefDistribution->relief_item_id ?? '';
        $this->distribution_type = $reliefDistribution->distribution_type ?? 'individual';
        $this->user_id = $reliefDistribution->user_id ?? '';
        $this->family_id = $reliefDistribution->family_id ?? '';
        $this->head_of_family_id = $reliefDistribution->head_of_family_id ?? '';
        $this->quantity = $reliefDistribution->quantity ?? '';
        $this->amount = $reliefDistribution->amount ?? '';
        $this->purpose = $reliefDistribution->purpose ?? '';
        $this->notes = $reliefDistribution->notes ?? '';
        $this->distributed_at = $reliefDistribution->distributed_at?->format('Y-m-d H:i') ?? now()->format('Y-m-d H:i');
    }

    public function updatedFamilyId($value)
    {
        if ($value) {
            $family = Family::find($value);
            if ($family) {
                $this->head_of_family_id = $family->head_of_family_id;
            }
        } else {
            $this->head_of_family_id = '';
        }
    }

    public function rules(): array
    {
        $rules = [
            'relief_operation_id' => ['required', 'exists:relief_operations,id'],
            'relief_item_id' => ['required', 'exists:relief_items,id'],
            'distribution_type' => ['required', 'in:individual,family'],
            'quantity' => ['required', 'numeric', 'min:0.01'],
            'amount' => ['nullable', 'numeric', 'min:0'],
            'purpose' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'distributed_at' => ['required', 'date'],
        ];

        if ($this->distribution_type === 'family') {
            $rules['family_id'] = ['required', 'exists:families,id'];
            $rules['head_of_family_id'] = ['required', 'exists:users,id'];
            $rules['user_id'] = ['required', 'exists:users,id']; // Representative
        } else {
            $rules['user_id'] = ['required', 'exists:users,id'];
            $rules['family_id'] = ['nullable'];
            $rules['head_of_family_id'] = ['nullable'];
        }

        return $rules;
    }

    public function validationAttributes(): array
    {
        return [
            'relief_operation_id' => 'relief operation',
            'relief_item_id' => 'relief item',
            'user_id' => $this->distribution_type === 'family' ? 'representative' : 'resident',
            'family_id' => 'family',
            'head_of_family_id' => 'head of family',
            'quantity' => 'quantity',
            'distributed_at' => 'distribution date',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        // Check if quantity is available
        $reliefItem = ReliefItem::findOrFail($this->relief_item_id);
        $availableQuantity = $reliefItem->quantity_received - $reliefItem->quantity_distributed;
        
        if ($this->reliefDistribution) {
            $availableQuantity += $this->reliefDistribution->quantity;
        }

        if ($this->quantity > $availableQuantity) {
            throw ValidationException::withMessages([
                'quantity' => "Available quantity is only {$availableQuantity} {$reliefItem->reliefType->unit}",
            ]);
        }

        // Verify family distribution if applicable
        if ($this->distribution_type === 'family') {
            $family = Family::findOrFail($this->family_id);
            if ($family->head_of_family_id != $this->head_of_family_id) {
                throw ValidationException::withMessages([
                    'head_of_family_id' => 'The selected head of family does not match the family.',
                ]);
            }
        }

        $data = $this->only([
            'relief_operation_id',
            'relief_item_id',
            'distribution_type',
            'user_id',
            'family_id',
            'head_of_family_id',
            'quantity',
            'amount',
            'purpose',
            'notes',
            'distributed_at',
        ]);

        $data['distributed_by'] = auth()->id();
        $data['distributed_at'] = $this->distributed_at;

        // Convert empty strings to null for nullable fields
        $data['amount'] = $data['amount'] === '' ? null : ($data['amount'] ? (float) $data['amount'] : null);
        $data['purpose'] = $data['purpose'] === '' ? null : $data['purpose'];
        $data['notes'] = $data['notes'] === '' ? null : $data['notes'];

        // Set null for unused fields
        if ($this->distribution_type === 'individual') {
            $data['family_id'] = null;
            $data['head_of_family_id'] = null;
        } else {
            // For family, user_id is the representative
        }

        if (!$this->reliefDistribution) {
            ReliefDistribution::create($data);
        } else {
            $this->reliefDistribution->update($data);
        }

        $this->reset();
    }
}

