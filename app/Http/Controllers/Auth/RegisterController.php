<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use App\Models\User_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;




class RegisterController extends Controller
{
    protected $pageData;
    public function __construct()
    {
        $this->middleware('guest');

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



//
public function doRegister(Request $request){
    $validator = Validator::make($request->all(), [
        'firstname'         => 'required|string',
        'username'          => 'required|string|unique:tb_users,user_name',
        'email'             => 'required|email|unique:tb_users,user_email',
        'password'          => 'required|min:6',
        'confirm-password'  => 'required|same:password',
        'terms'             => 'required|accepted',
    ],
    [
        'firstname.required' => 'The firstname field is required.',
        'username.required' => 'The username field is required.',
        'email.required' => 'The email field is required.',
        'password.required' => 'The password field is required.',
        'confirm-password.required' => 'The confirm password field is required.',
        'terms.required' => 'You must accept the terms and conditions.',
        'email.email' => 'The email must be a valid email address.',
        'password.min' => 'The password must be at least :min characters.',
        'confirm-password.same' => 'The confirm password must match the password.',
    ]);
    if ($validator->fails()) {
        $toast_message = $validator->errors()->all();
        Session::flash('errors', $toast_message);
        return redirect()->back()->withErrors($validator)->withInput();
    }


    User_Model::create([
        'firstname'     => $request->input('firstname'),
        'lastname'      => $request->input('lastname'),
        'user_name'     => $request->input('username'),
        'user_email'    => $request->input('email'),
        'user_pwd'      => Hash::make($request->input('password')),
        'type'          => "2"
    ]);
    Session::flash('success', ['Registration successful!']);
    return redirect()->route('login.show');
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
    public function setReturnView($viewurl, $lastValidationData = [])
    {
        $pageData = Session::get('page');
        $mergedData = array_merge($lastValidationData, ['pageData' => $pageData]);
        return view($viewurl, $mergedData);
    }
}
