<?php

namespace App\Livewire\Forms;

use App\Models\IncidentReport;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class IncidentReportForm extends Form
{
    use WithFileUploads;

    public ?IncidentReport $incidentReport = null;

    public string $title = '';
    public string $name = '';
    public string $narration = '';
    public string $date = '';
    public int $user_id = 1;
    public $image = null;
    public string $image_position = 'before';
    public ?string $existing_image = null;

    public function mount(): void
    {
        // Set default date to today if not editing
        if (empty($this->date)) {
            $this->date = now()->format('Y-m-d');
        }
    }

    /**
     * @param IncidentReport|null $incidentReport
     */
    public function setIncidentReport(?IncidentReport $incidentReport = null): void
    {
        $this->incidentReport = $incidentReport;
        $this->title = $incidentReport->title ?? '';
        $this->name = $incidentReport->name ?? '';
        $this->narration = $incidentReport->narration ?? '';
        $this->date = $incidentReport->date ?? '';
        $this->image_position = $incidentReport->image_position ?? 'before';
        $this->existing_image = $incidentReport->image_path ?? null;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'name' => ['required'],
            'narration' => ['required'],
            'date' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:5120'], // 5MB max
            'image_position' => ['required', 'in:before,after'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'title' => 'title',
            'name' => 'name',
            'narration' => 'narration',
            'date' => 'date',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        
        $data = [
            'title' => $this->title,
            'name' => $this->name,
            'narration' => $this->narration,
            'date' => $this->date,
            'image_position' => $this->image_position,
        ];

        // Handle image upload
        if ($this->image) {
            // Delete old image if exists
            if ($this->incidentReport && $this->incidentReport->image_path) {
                Storage::disk('public')->delete($this->incidentReport->image_path);
            }
            // Store new image
            $data['image_path'] = $this->image->store('incident-reports', 'public');
        } elseif ($this->incidentReport && $this->incidentReport->image_path) {
            // Keep existing image if no new image uploaded
            $data['image_path'] = $this->incidentReport->image_path;
        }

        if (!$this->incidentReport) {
            if (auth()->user()) {
                $data['user_id'] = auth()->user()->id;
                $this->incidentReport = auth()->user()->incidentReports()->create($data);
            } else {
                $data['user_id'] = $this->user_id;
                $this->incidentReport = IncidentReport::create($data);
            }
        } else {
            $this->incidentReport->update($data);
        }
        $this->reset();
    }

    public function removeImage(): void
    {
        if ($this->incidentReport && $this->incidentReport->image_path) {
            Storage::disk('public')->delete($this->incidentReport->image_path);
            $this->incidentReport->update(['image_path' => null]);
            $this->existing_image = null;
        }
        $this->image = null;
    }
}
