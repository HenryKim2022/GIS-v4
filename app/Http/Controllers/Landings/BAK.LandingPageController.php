<?php

namespace App\Http\Controllers\Landings;

use App\Http\Controllers\Controller;
use App\Models\Institution_Model;
use App\Models\Image_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\Models\Mark_Model;
use App\Models\Category_Model;

use Illuminate\Support\Facades\Storage;




class LandingPageController extends Controller
{
    protected $pageData;
    public function __construct()
    {

        // if ($this->middleware('auth')){
        //     echo ('console.log("LOGIN FIRST :)")');
        // }

        $this->pageData = [
            'page_title' => 'What Public See',
            'page_url' => base_url('public-url'),
        ];
        Session::put('page', $this->pageData);
    }


    //
    public function index(){
        $process = $this->setPageSession("Landing Page", "landing-page");
        if ($process){
            return view('landings/pages/v_landing_customizer');
        }
    }







    ///////////////////////////// PAGE SETTER ////////////////////////////
    public function setPageSession($pageTitle, $pageUrl){
        $pageData = Session::get('page');
        $pageData['page_title'] = $pageTitle;
        $pageData['page_url'] = $pageUrl;

        // Store the updated array back in the session
        Session::put('page', $pageData);
        return true;
    }
    public function setReturnView($viewurl){
        $pageData = Session::get('page');
        return view($viewurl, ['pageData' => $pageData]);
    }
}
