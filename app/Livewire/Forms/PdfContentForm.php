<?php

namespace App\Livewire\Forms;

use App\Models\PdfContent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class PdfContentForm extends Form
{
    public $header = null;  // Accepts file upload
    public string $captain = '';
    public ?PdfContent $pdfContent = null;

    public function setPdfContent(?PdfContent $pdfContent = null): void
    {
        $this->pdfContent = $pdfContent;
        if ($pdfContent) {
           $this->header = $pdfContent->header ?? '';
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
            'header' => ['nullable', 'image', 'max:2048'], // max 2MB
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

        if ($this->header instanceof UploadedFile) {
            $data['header'] = $this->header->store('header', 'public');
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