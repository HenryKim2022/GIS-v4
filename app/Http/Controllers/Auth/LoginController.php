<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;





class LoginController extends Controller
{
    protected $pageData;
    public function __construct()
    {
        $this->pageData = [
            'page_title' => 'What Public See',
            'page_url' => base_url('login-url'),
        ];
        Session::put('page', $this->pageData);
    }


    public function index()
    {
        $process = $this->setPageSession("Login Page", "login");
        if ($process) {
            return view('auth/v_login');
        }
    }


    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'username-email' => 'required',
            'password' => 'required',
        ]);
        $validator->after(function ($validator) use ($request) {        // Custom Validation: Check username/email exist
            $usernameEmail = $request->input('username-email');
            $user = User_Model::where(function ($query) use ($usernameEmail) {
                $query->where('user_name', $usernameEmail)
                    ->orWhere('user_email', $usernameEmail);
            })->first();
            if (!$user) {
                $validator->errors()->add('username-email', 'The username or email not registered.');
            }
        });
        $validator->validate();

        // Get Field Value
        $credentials = $request->only('username-email', 'password');
        $usernameEmail = $credentials['username-email'];
        $password = $credentials['password'];

        // Check Logins
        $user = User_Model::where(function ($query) use ($usernameEmail) {
            $query->where('user_name', $usernameEmail)
                ->orWhere('user_email', $usernameEmail);
        })->first();
        if ($user && Hash::check($password, $user->user_pwd)) {
            // Authentication successful
            // You can perform further actions here, such as setting session variables or redirecting to a dashboard page
            return redirect()->route('dashboard.page')->with('success', 'Login successful!');
        } else {
            // Authentication failed
            // You may return an error message or redirect back to the login page with an error
            // return redirect()->route('login.show')->with('error', 'Login failed!');
            return redirect()->route('login.show')->withErrors(['error' => 'Login failed!']);
        }
    }



    public function forgotPassword()
    {
        $process = $this->setPageSession("Forgot Password Page", "forgot");
        if ($process) {
            return view('auth/v_forgot_pass');
        }
    }







    ///////////////////////////// PAGE SETTER ////////////////////////////
    public function setPageSession($pageTitle, $pageUrl)
    {
        $pageData = Session::get('page');
        $pageData['page_title'] = $pageTitle;
        $pageData['page_url'] = $pageUrl;

        // Store the updated array back in the session
        Session::put('page', $pageData);
        return true;
    }
    public function setReturnView($viewurl)
    {
        $pageData = Session::get('page');
        return view($viewurl, ['pageData' => $pageData]);
    }
}
