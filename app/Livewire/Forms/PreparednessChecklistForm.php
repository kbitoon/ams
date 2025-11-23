<?php

namespace App\Livewire\Forms;

use App\Models\PreparednessChecklist;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class PreparednessChecklistForm extends Form
{
    public ?PreparednessChecklist $checklist = null;

    public string $disaster_type_id = '';
    public string $title = '';
    public string $description = '';
    public int $order = 0;
    public bool $is_active = true;
    public array $items = [];

    public function setChecklist(?PreparednessChecklist $checklist = null): void
    {
        $this->checklist = $checklist;
        $this->disaster_type_id = $checklist->disaster_type_id ?? '';
        $this->title = $checklist->title ?? '';
        $this->description = $checklist->description ?? '';
        $this->order = $checklist->order ?? 0;
        $this->is_active = $checklist->is_active ?? true;
        
        if ($checklist) {
            $this->items = $checklist->items->map(function($item) {
                return [
                    'id' => $item->id,
                    'item' => $item->item,
                    'description' => $item->description ?? '',
                    'order' => $item->order,
                    'is_required' => $item->is_required,
                ];
            })->toArray();
        }
    }

    public function rules(): array
    {
        return [
            'disaster_type_id' => ['required', 'exists:disaster_types,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
            'items' => ['array'],
            'items.*.item' => ['required', 'string', 'max:255'],
            'items.*.description' => ['nullable', 'string'],
            'items.*.order' => ['integer', 'min:0'],
            'items.*.is_required' => ['boolean'],
        ];
    }

    public function addItem(): void
    {
        $this->items[] = [
            'id' => null,
            'item' => '',
            'description' => '',
            'order' => count($this->items),
            'is_required' => false,
        ];
    }

    public function removeItem($index): void
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function save(): void
    {
        $this->validate();

        // Filter out empty items
        $this->items = array_filter($this->items, function($item) {
            return !empty($item['item']);
        });
        $this->items = array_values($this->items);

        if (!$this->checklist) {
            $checklist = PreparednessChecklist::create($this->only([
                'disaster_type_id',
                'title',
                'description',
                'order',
                'is_active',
            ]));

            foreach ($this->items as $index => $item) {
                $checklist->items()->create([
                    'item' => $item['item'],
                    'description' => $item['description'] ?? null,
                    'order' => $item['order'] ?? $index,
                    'is_required' => $item['is_required'] ?? false,
                ]);
            }
        } else {
            $this->checklist->update($this->only([
                'disaster_type_id',
                'title',
                'description',
                'order',
                'is_active',
            ]));

            // Get existing item IDs
            $existingIds = collect($this->items)->pluck('id')->filter()->toArray();
            
            // Delete items not in the list
            $this->checklist->items()->whereNotIn('id', $existingIds)->delete();

            // Update or create items
            foreach ($this->items as $index => $item) {
                if (isset($item['id']) && $item['id']) {
                    $this->checklist->items()->where('id', $item['id'])->update([
                        'item' => $item['item'],
                        'description' => $item['description'] ?? null,
                        'order' => $item['order'] ?? $index,
                        'is_required' => $item['is_required'] ?? false,
                    ]);
                } else {
                    $this->checklist->items()->create([
                        'item' => $item['item'],
                        'description' => $item['description'] ?? null,
                        'order' => $item['order'] ?? $index,
                        'is_required' => $item['is_required'] ?? false,
                    ]);
                }
            }
        }

        $this->reset();
    }
}

