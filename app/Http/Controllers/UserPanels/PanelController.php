<?php

namespace App\Http\Controllers\UserPanels;

use App\Http\Controllers\Controller;
use App\Models\Mark_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        $process = $this->setPageSession("Dashboard", "dashboard");
        if ($process) {
            return $this->setReturnView('userpanels/pages/v_dashboard');
        }
    }

    public function myprofile()
    {
        $process = $this->setPageSession("My Profile", "myprofile");
        if ($process) {
            return $this->setReturnView('userpanels/pages/v_userprofile');
        }
    }

    // public function logout()
    // {
    //     $process = $this->setPageSession("Login Page", "login");
    //     if ($process) {
    //         $toast_message = [
    //             'Logged Out :)'
    //         ];
    //         Session::flash('success', $toast_message);
    //         return Redirect::to('/login');
    //     }
    // }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $toast_message = [
            'Logged Out :)'
        ];
        Session::flash('success', $toast_message);
        return Redirect::to('/login');
    }

    public function manage_institutions()
    {
        $process = $this->setPageSession("Manage Institutions", "m-inst");
        if ($process) {
            return $this->setReturnView('userpanels/pages/v_m_institutions');
        }
    }






    ///////////////////////////// PAGE TITLE & URL SETTER ////////////////////////////
    public function setPageSession($pageTitle, $pageUrl, $lastTab = "")    // Param1 = page title, Param2 = page url !
    {
        $pageData = Session::get('page');
        $pageData['page_title'] = $pageTitle;
        $pageData['page_url'] = $pageUrl;

        $lastTab = $lastTab == "" ? 'from-maps' : $lastTab;
        $pageData['last_tab'] = $lastTab;

        // Store the updated array back in the session
        Session::put('page', $pageData);
        return true;
    }
    public function setReturnView($viewurl, $loadMarksFromDB = [])
    {
        $pageData = Session::get('page');
        $mergedData = array_merge($loadMarksFromDB, ['pageData' => $pageData]);
        return view($viewurl, $mergedData);
    }
}
