<?php

namespace App\Http\Controllers;

use App\Models\LuponCaseComment;
use App\Models\LuponCase;
use App\Models\LuponCaseComplainant;
use App\Models\LuponCaseRespondent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
