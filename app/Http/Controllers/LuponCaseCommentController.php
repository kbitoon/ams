<?php

namespace App\Http\Controllers;

use App\Models\LuponCaseComment;
use App\Models\LuponCase;
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
}
