<?php

namespace App\Http\Controllers;

use App\Models\LuponCaseComment;
use App\Models\LuponCase;
use App\Models\LuponSummonTracking;
use App\Models\LuponCaseComplainant;
use App\Models\LuponCaseRespondent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Log;

class LuponCaseCommentController extends Controller
{
    public function store(Request $request, LuponCase $luponCase)
    {
        $request->validate([
            'luponCaseComment' => 'required|string|max:2000',
        ]);

        LuponCaseComment::create([
            'comment' => $request->luponCaseComment,
            'user_id' => Auth::id(),
            'lupon_case_id' => $luponCase->id,
        ]);

        return redirect()->back()->with('message', 'Comment uploaded successfully!');
    }
    public function downloadPdf($id)
    {
        $luponCase = LuponCase::with(['luponCaseComplainants', 'luponCaseRespondents', 'assets', 'luponCaseComments'])->findOrFail($id);

        // Fetch the latest or relevant PdfContent record
        $pdfContent = \App\Models\PdfContent::latest()->first();

        $pdf = Pdf::loadView('pdf.lupon_case', compact('luponCase', 'pdfContent'));

        return $pdf->download("lupon_case_{$luponCase->case_no}.pdf");
    }

    public function downloadSummonPdf($luponCaseId, Request $request)
    {
        $summonedDate = $request->query('summoned_date');
        $dateIssued = $request->query('date_issued');

        // Always get the LuponCase
        $luponCase = LuponCase::with(['luponCaseComplainants', 'luponCaseRespondents'])->findOrFail($luponCaseId);

        // Get the latest summon if it exists, but it's optional
        $luponSummon = LuponSummonTracking::where('lupon_case_id', $luponCaseId)
            ->latest()
            ->first();

        $pdfContent = \App\Models\PdfContent::latest()->first();

        // Pass the dates and both models to the view
        $pdf = Pdf::loadView('pdf.summon', compact('luponSummon', 'luponCase', 'pdfContent', 'summonedDate', 'dateIssued'));

        return $pdf->download("lupon_summon_{$luponCase->case_no}.pdf");
    }
}
