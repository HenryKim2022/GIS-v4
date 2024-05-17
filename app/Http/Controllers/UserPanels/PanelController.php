<?php

namespace App\Http\Controllers\UserPanels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PanelController extends Controller
{
    protected $pageData;
    public function __construct()
    {
        $this->pageData = [
            'page_title' => 'User Panel',
            'page_url' => base_url('userpanel'),
        ];
        Session::put('page', $this->pageData);
    }


    //
    public function index(){
        $process = $this->setPageSession("Dashboard", "dashboard");
        if ($process){
            return $this->setReturnView('userpanels/pages/v_dashboard');
        }
    }

    public function myprofile(){
        $process = $this->setPageSession("My Profile", "myprofile");
        if ($process){
            return $this->setReturnView('userpanels/pages/v_userprofile');
        }

    }

    public function logout(){
        $process = $this->setPageSession("Login Page", "login");
        if ($process){
            return Redirect::to('/login');
        }
    }

    public function manage_institutions(){
        $process = $this->setPageSession("Manage Institutions", "m-inst");
        if ($process){
            return $this->setReturnView('userpanels/pages/v_m_institutions');
        }
    }

    public function manage_markings(){
        $process = $this->setPageSession("Manage Markings", "m-mark");
        if ($process){
            return $this->setReturnView('userpanels/pages/v_m_marks');
        }
    }







    ///////////////////////////// PAGE TITLE & URL SETTER ////////////////////////////
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
