<?php

namespace App\Livewire\Forms;

use App\Models\ReliefProvider;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ReliefProviderForm extends Form
{
    public ?ReliefProvider $reliefProvider = null;

    public string $name = '';
    public string $type = '';
    public string $contact_person = '';
    public string $contact_number = '';
    public string $email = '';
    public string $address = '';
    public string $notes = '';
    public bool $is_active = true;

    public function setReliefProvider(?ReliefProvider $reliefProvider = null): void
    {
        $this->reliefProvider = $reliefProvider;
        $this->name = $reliefProvider->name ?? '';
        $this->type = $reliefProvider->type ?? '';
        $this->contact_person = $reliefProvider->contact_person ?? '';
        $this->contact_number = $reliefProvider->contact_number ?? '';
        $this->email = $reliefProvider->email ?? '';
        $this->address = $reliefProvider->address ?? '';
        $this->notes = $reliefProvider->notes ?? '';
        $this->is_active = $reliefProvider->is_active ?? true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'in:government,ngo,private,individual,other'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'type' => 'type',
            'email' => 'email',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        if (!$this->reliefProvider) {
            ReliefProvider::create($this->only([
                'name',
                'type',
                'contact_person',
                'contact_number',
                'email',
                'address',
                'notes',
                'is_active',
            ]));
        } else {
            $this->reliefProvider->update($this->only([
                'name',
                'type',
                'contact_person',
                'contact_number',
                'email',
                'address',
                'notes',
                'is_active',
            ]));
        }

        $this->reset();
    }
}

