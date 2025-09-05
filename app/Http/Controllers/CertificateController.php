<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use App\Models\PdfContent;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CertificateController extends Controller
{
    public function downloadPdf($id)
    {
        $clearance = Clearance::findOrFail($id);

        $clearance->age = $clearance->date_of_birth
            ? Carbon::parse($clearance->date_of_birth)->age
            : null;

        $pdfContent = PdfContent::orderBy('created_at', 'desc')->first();

        $pdf = Pdf::loadView('pdf.certificate', [
            'clearance' => $clearance,
            'pdfContent' => $pdfContent,
        ]);

        return $pdf->download("certificate_{$clearance->name}.pdf");
    }
}
