<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\LuponHearing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HearingCommentController extends Controller
{
    public function store(Request $request, LuponHearing $luponHearing)
    {
        // Validate the incoming request
        $request->validate([
            'comment' => 'required|string|max:2000',
        ]);

        // Create the comment
        Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'lupon_hearing_id' => $luponHearing->id,
        ]);

        //redirect back with a success message
        return redirect()->back()->with('message', 'Comment uploaded successfully!');
    }
}
