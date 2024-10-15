<?php

namespace App\Http\Controllers;

use App\Models\Information;

class PublicInformationController extends Controller
{
    public function show($id)
    {
        // Fetch the information record
        $information = Information::findOrFail($id);
        
        // Return the public view with the information
        return view('public.information', compact('information'));
    }
}
