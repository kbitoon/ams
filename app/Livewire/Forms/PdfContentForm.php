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
    public $footer = null;  // Accepts file upload
    public $watermark = null;  // Accepts file upload
    public string $captain = '';
    public int $clearance_expiration_days = 30;
    public ?PdfContent $pdfContent = null;

    public function setPdfContent(?PdfContent $pdfContent = null): void
    {
        $this->pdfContent = $pdfContent;
        if ($pdfContent) {
           $this->header = $pdfContent->header ?? '';
            $this->captain = $pdfContent->captain ?? '';
            $this->footer = $pdfContent->footer ?? '';
            $this->watermark = $pdfContent->watermark ?? '';
            $this->clearance_expiration_days = $pdfContent->clearance_expiration_days ?? 30;
        }
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'captain' => ['required', 'string', 'max:255'],
            'header' => ['nullable', 'max:2048'], // max 2MB
            'footer' => ['nullable', 'max:2048'], // max 2MB
            'watermark' => ['nullable', 'max:2048'], //
            'clearance_expiration_days' => ['required', 'integer', 'min:1', 'max:365'],
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
            'clearance_expiration_days' => $this->clearance_expiration_days,
        ];

        if ($this->header instanceof UploadedFile) {
            $data['header'] = $this->header->store('header', 'public');
        }
        if ($this->footer instanceof UploadedFile) {
            $data['footer'] = $this->footer->store('footer', 'public');
        }
        if ($this->watermark instanceof UploadedFile) {
            $data['watermark'] = $this->watermark->store('watermark', 'public');
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