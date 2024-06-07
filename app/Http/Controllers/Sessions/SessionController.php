<?php

namespace App\Http\Controllers\Sessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    public function clearSuccessMessages(Request $request)
    {
        $request->session()->forget('success');
        return "<script>console.log('Success messages session cleared)</script>";
        // return response()->json(['message' => 'Success messages cleared'], 200);
    }

    public function clearErrorMessages(Request $request)
    {
        $request->session()->forget('errors');
        return "<script>console.log('Errors messages session cleared)</script>";
        // return response()->json(['message' => 'Errors messages cleared'], 200);
    }


}
