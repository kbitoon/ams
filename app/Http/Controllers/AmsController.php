<?php

namespace App\Http\Controllers;
use App\Models\ClearancePurpose;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AmsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clearancepurpose(Request $request)
    {
        $tmp = DB::table("clearance_purpose")->select('purpose')->get();
        return response()->json($tmp);
        
        // $tmp = DB::table("clearance_purpose")->select('purpose')->get();
        // return response()->json($tmp);

        // $purposes = [
        //     ['label' => 'Employment', 'value' => 'Employment'],
        //     ['label' => 'Business', 'value' => 'Business']
        // ];

        // return response()->json($purposes);

        // $purposes = DB::table('clearance_purpose')->select('purpose')->get();
        
        // // Format the data as needed
        // $formattedPurposes = $purposes->map(function($purpose) {
        //     return [
        //         'label' => $purpose->purpose,
        //         'value' => $purpose->purpose
        //     ];
        // });

        // return response()->json($formattedPurposes);
    }

    public function clearancepurposemodal(Request $request)
    {
        $purposes = DB::table('clearance_purpose')->select('purpose')->get();
        
        // Format the data as needed
        $formattedPurposes = $purposes->map(function($purpose) {
            return [
                'label' => $purpose->purpose,
                'value' => $purpose->purpose
            ];
        });

        return response()->json($formattedPurposes);

        // $query = $request->get('query');

        // $purposes = DB::table('clearance_purpose')
        //     ->where('purpose', 'LIKE', "%{$query}%")
        //     ->get(['purpose']);

        // $formattedPurposes = $purposes->map(function($purpose) {
        //     return ['label' => $purpose->purpose, 'value' => $purpose->purpose];
        // });

        // Log::info('Purposes: ', $formattedPurposes->toArray());

        // return response()->json($formattedPurposes);
    }

}
