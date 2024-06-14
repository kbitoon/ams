<?php

namespace App\Http\Controllers;
use App\Models\ClearancePurpose;
use DB;

class AmsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clearancepurpose()
    {
        $tmp = DB::table("clearance_purpose")->select('purpose')->get();
        return response()->json($tmp);
    }
}
