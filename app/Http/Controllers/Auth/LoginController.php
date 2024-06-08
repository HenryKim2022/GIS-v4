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
        $this->middleware('guest')->except('logout');

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
        $validator = Validator::make($request->all(), []);
        $validator->after(function ($validator) use ($request) {        // Custom Validation: Check username/email exist
            $usernameEmail = $request->input('username-email');
            $password = $request->input('password');
            $user = User_Model::where(function ($query) use ($usernameEmail) {
                $query->where('user_name', $usernameEmail)
                    ->orWhere('user_email', $usernameEmail);
            })->first();

            if ($usernameEmail && $password) {
                if (!$user) {
                    $validator->errors()->add('username-email', 'The username or email not registered.');
                } elseif (!Hash::check($password, $user->user_pwd)) {
                    $validator->errors()->add('password', 'The password is incorrect.');
                }
            } else if ($usernameEmail) {
                $validator->errors()->add('password-email', 'The password required.');
            } else if ($password) {
                $validator->errors()->add('username-email', 'The username/email required.');
            } else {
                $validator->errors()->add('username-email', 'The username/email required.');
                $validator->errors()->add('password-email', 'The password required.');
            }
        });
        $validator->validate();


        // Get Field Value
        $credentials = $request->only('username-email', 'password');
        $usernameEmail = $credentials['username-email'];
        $password = $credentials['password'];
        $rememberMe = $request->boolean('remember-me');

        // Attempt Authentication
        if (
            Auth::attempt(['user_name' => $usernameEmail, 'password' => $password])
            || Auth::attempt(['user_email' => $usernameEmail, 'password' => $password], $rememberMe)
        ) {
            // Authentication successful
            $request->session()->regenerate();

            Session::flash('success', ['Welcome back :)']);
            return redirect()->route('dashboard.page');
        } else {
            // Authentication failed
            Session::flash('errors', ['Invalid credentials.']);
            return redirect()->back();
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
