<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function upload(Request $request)
{
    // Validate the uploaded photo
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=1500,min_height=400',
    ]);

    // Get the original filename
    $originalFilename = $request->file('photo')->getClientOriginalName();

    // Define a custom filename, for example appending a timestamp to make it unique
    $filename = time() . '_' . $originalFilename;

    // Store the file publicly with the custom filename
    $path = $request->file('photo')->storePubliclyAs('photos', $filename, 'public');

    // Save the photo path to the database
    Photo::create(['path' => $path]);

    return redirect()->back()->with('message', 'Photo uploaded successfully!')->with('path', $path);
}

}

