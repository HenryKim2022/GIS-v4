<?php

namespace App\Http\Controllers\UserPanels;

use App\Http\Controllers\Controller;
use App\Models\User_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class PanelController extends Controller
{
    protected $pageData;
    public function __construct()
    {

        $this->middleware('auth');
        $this->pageData = [
            'page_title' => 'User Panel',
            'page_url' => base_url('userpanel'),
        ];
        Session::put('page', $this->pageData);
    }


    //
    public function index()
    {
        // better program set session here, if user not auth
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

    public function edit_myprofile_img(Request $request)
    {
    }

    public function edit_myprofile_bio(Request $request)
    {
        $user = User_Model::where('user_id', $request->input('user_id'))->first();
        if ($user) {
            $user->firstname = $request->input('firstName');
            $user->lastname = $request->input('lastName');
            $user->user_name = $request->input('userName');
            $user->save();
            Session::flash('success', ['Logged Out! Your data account was updated, Please relogin :)']);
            return redirect()->route('logout.redirect');
            //  return Redirect::back();
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    public function edit_myprofile_pass(Request $request)
    {
        $user = User_Model::where('user_id', $request->input('user_id'))->first();
        if ($user) {
            $user->user_pwd = Hash::make($request->input('newPassword'));
            $user->save();
            Session::flash('success', ['Logged Out! Your data account was updated, Please relogin :)']);
            return redirect()->route('logout.redirect');
            // return Redirect::back();
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }



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
