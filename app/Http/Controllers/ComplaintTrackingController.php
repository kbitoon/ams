<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class ComplaintTrackingController extends Controller
{
    /**
     * Show the track complaint form.
     */
    public function showTrackForm()
    {
        // Just return the form without any data initially
        return view('track-complaint');
    }

    /**
     * Track a complaint by its reference ID.
     */
    public function trackComplaint(Request $request)
    {
        // Validate the reference ID input
        $request->validate([
            'reference_id' => 'required|string',
        ]);

        // Decode the Base64 reference ID
        $decodedId = base64_decode($request->input('reference_id'));

        // Find the complaint by the decoded ID
        $complaint = Complaint::find($decodedId);

        // If complaint is not found, return with an error message
        if (!$complaint) {
            return redirect()->back()->with('error', 'Complaint not found.');
        }

        // If complaint is found, return the view with the complaint data
        return view('track-complaint', ['complaint' => $complaint]);
    }
}
