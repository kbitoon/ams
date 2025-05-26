<?php

namespace App\Livewire;

use App\Models\PdfContent as PdfContentModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class PdfContent extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    public function delete($id)
    {
        $pdfContent = PdfContentModel::findOrFail($id);
        $pdfContent->delete();

        $this->dispatch('refresh-list');
    }

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */   
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('pdf.pdf-content', [
            'pdfContents' => PdfContentModel::paginate(10),
        ]);
    }
}
