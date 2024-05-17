<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    protected $pageData;
    public function __construct()
    {
        $this->pageData = [
            'page_title' => 'What Public See',
            'page_url' => base_url('register-url'),
        ];
        Session::put('page', $this->pageData);
    }


    //
    public function index(){
        $process = $this->setPageSession("Register Page", "register");
        if ($process){
            return view('auth/v_register');
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
