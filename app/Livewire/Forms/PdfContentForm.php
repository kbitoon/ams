<?php

namespace App\Livewire\Forms;

use App\Models\PdfContent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class PdfContentForm extends Form
{
    public $right_logo = null; // Accepts file upload
    public $left_logo = null;  // Accepts file upload
    public string $captain = '';
    public ?PdfContent $pdfContent = null;

    public function setPdfContent(?PdfContent $pdfContent = null): void
    {
        $this->pdfContent = $pdfContent;
        if ($pdfContent) {
            $this->right_logo = $pdfContent->right_logo ?? null;
            $this->left_logo = $pdfContent->left_logo ?? null;
            $this->captain = $pdfContent->captain ?? '';
        }
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'captain' => ['required', 'string', 'max:255'],
            'right_logo' => ['nullable', 'image', 'max:2048'], // max 2MB
            'left_logo' => ['nullable', 'image', 'max:2048'],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        $data = [
            'captain' => $this->captain,
        ];

        // Handle right_logo upload
        if ($this->right_logo instanceof UploadedFile) {
            $data['right_logo'] = $this->right_logo->store('logos', 'public');
        }

        // Handle left_logo upload
        if ($this->left_logo instanceof UploadedFile) {
            $data['left_logo'] = $this->left_logo->store('logos', 'public');
        }

        if (!$this->pdfContent) {
            $pdfContent = PdfContent::create($data);
        } else {
            $this->pdfContent->update($data);
            $pdfContent = $this->pdfContent;
        }

        $this->reset();
    }
}