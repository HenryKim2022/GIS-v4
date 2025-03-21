<?php

namespace App\Http\Controllers\UserPanels;

use App\Http\Controllers\Controller;
use App\Models\User_Model;
use App\Models\Category_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        $process = $this->setPageSession("Dashboard", "dashboard");
        if ($process) {
            $categories = Category_Model::with('tb_institution')->withoutTrashed()->get();
            return $this->setReturnView('userpanels.pages.v_dashboard', compact('categories'));
        }
    }


    public function load_dashboard_chart()
    {
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
        $user = User_Model::where('user_id', $request->input('user_id'))->first();
        if ($user) {
            if ($request->hasFile('user_img')) {
                $file = $request->file('user_img');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                // Store the uploaded file in the storage/app/public directory
                Storage::putFileAs('public', $file, $filename);
                $user->user_image = asset('public/storage/' . $filename);;
                $user->save();

                // Update the authenticated_user_data session variable
                $updatedUser = User_Model::find($user->user_id);
                Session::put('authenticated_user_data', $updatedUser);

                Session::flash('success', ['User image updated successfully']);
            } else {
                $user->save();
                Session::flash('errors', ['User image update failed']);
            }
        } else {
            // Handle the case when the user is not found
            Session::flash('errors', ['Err[404]: User not found']);
        }
        return response()->json(['reload' => true]);
    }



    public function edit_myprofile_bio(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'firstName'  => 'sometimes|required|min:5',
                'userName'   => [
                    'sometimes',
                    'required',
                    'string',
                    Rule::unique('tb_users', 'user_name')->ignore($request->input('user_id'), 'user_id')
                ],
                'userEmail'  => [
                    'sometimes',
                    'required',
                    'email',
                    Rule::unique('tb_users', 'user_email')->ignore($request->input('user_id'), 'user_id')
                ],
            ],
            [
                'firstName.required' => 'The firstname field is required.',
                'userName.required'  => 'The username field is required.',
                'userEmail.required' => 'The email field is required.',
            ]
        );
        if ($validator->fails()) {
            $toast_message = $validator->errors()->all();
            Session::flash('errors', $toast_message);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User_Model::where('user_id', $request->input('user_id'))->first();
        if ($user) {
            $user->firstname = $request->input('firstName');
            $user->lastname = $request->input('lastName');
            $user->user_name = $request->input('userName');
            $user->user_email = $request->input('userEmail');
            $user->save();

            $updatedUser = User_Model::find($user->user_id);
            Session::put('authenticated_user_data', $updatedUser);

            Session::flash('success', ['Your account data was updated!']);
        } else {
            Session::flash('errors', ['Err[404]: Failed to update user account!']);
        }
        return redirect()->back();
    }

    public function edit_myprofile_pass(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'newPassword'       => 'required|min:6',
                'confirm-Password'  => 'required|same:newPassword',
            ],
            [
                'password.required' => 'The password field is required.',
                'confirm-password.required' => 'The confirm password field is required.',
                'password.min' => 'The password must be at least :min characters.',
                'confirm-password.same' => 'The confirm password must match the password.',
            ]
        );
        if ($validator->fails()) {
            $toast_message = $validator->errors()->all();
            Session::flash('errors', $toast_message);
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $user = User_Model::where('user_id', $request->input('user_id'))->first();
        if ($user) {
            $user->user_pwd = Hash::make($request->input('newPassword'));
            $user->save();

            $updatedUser = User_Model::find($user->user_id);
            Session::put('authenticated_user_data', $updatedUser);

            Session::flash('success', ['Your data account was updated!']);
        } else {
            Session::flash('errors', ['Err[404]: Failed to update data account!']);
        }
        return Redirect::back();
    }



    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        Session::flash('success', ['Logged Out :)']);
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
