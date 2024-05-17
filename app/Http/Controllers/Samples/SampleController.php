<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    //
    public function myviewport(){
        return view('samples/v_see_viewport');
    }
}
