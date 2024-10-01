<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Complaint $complaint)
    {
        // Validate the incoming request
        $request->validate([
            'comment' => 'required|string|max:2000',
        ]);

        // Create the comment
        Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'complaint_id' => $complaint->id,
        ]);

        //redirect back with a success message
        return redirect()->back()->with('message', 'Comment uploaded successfully!');
    }
}
