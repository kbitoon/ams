<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\PdfContentForm;
use App\Models\PdfContent;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class PdfContentModal extends ModalComponent
{
    use WithFileUploads;

    public ?PdfContent $pdfContent = null;
    public PdfContentForm $form;

    /**
     * @param PdfContent|null $pdfContent
     */
    public function mount(PdfContent $pdfContent = null): void
    {
        if ($pdfContent && $pdfContent->exists) {
            $this->form->setPdfContent($pdfContent);
        }

        $this->roles = PdfContent::all();
    }

    /**
     * Save PDF Content
     */
    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.forms.content-form');
    }
}