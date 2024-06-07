<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User_Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
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
        $loadUsersFromDB = User_Model::withoutTrashed()->get(); // Retrieve the marks from the database (exclude: softDeleted's).

        // Decrypt passwords
        $decryptedUsers = $loadUsersFromDB->map(function ($user) {
            // $user->user_pwd = Crypt::decryptString($user->user_pwd);
            $user->user_pwd = $user->user_pwd;
            return $user;
        });

        $process = $this->setPageSession("Manage Users", "m-userlist");
        if ($process) {
            return $this->setReturnView('userpanels/pages/v_m_users', ['loadUsersFromDB' => $decryptedUsers]);
        }
    }

    public function add_user(Request $request)
    {
        $firstName = $request->input('modalEditUserFirstname1');
        $lastName = $request->input('modalEditUserLastname1');
        $userName = $request->input('modalEditUsername1');
        // $userPwd = Crypt::encryptString($request->input('modalEditUserPassword1'));
        $userPwd = Hash::make($request->input('modalEditUserPassword1'));

        $user = new User_Model();
        $user->firstname = $firstName;
        $user->lastname = $lastName;
        $user->user_name = $userName;
        $user->user_pwd= $userPwd;
        $user->user_image = "";
        $user->save();
        return Redirect::back();
    }


    public function edit_user(Request $request)
    {

        // $user = User_Model::find($request->input('modalEdituserID2'));
        $user = User_Model::where('user_id', $request->input('modalEditUserID2'))->first();
        if ($user) {
            $user->firstname = $request->input('modalEditUserFirstname2');
            $user->lastname = $request->input('modalEditUserLastname2');
            $user->user_name = $request->input('modalEditUsername2');
            // $user->user_pwd = Crypt::encryptString($request->input('modalEditUserPassword2'));
            $user->user_pwd = Hash::make($request->input('modalEditUserPassword2'));
            $user->save();
            return Redirect::back();
        } else {
            // Handle the case when the category is not found
            return response()->json(['error' => 'User not found'], 404);
        }
    }


    public function delete_user(Request $request)
    {
        $user = User_Model::find($request->input('user_id'));
        if ($user) {
            $user->delete();
            // return response()->json(['success' => 'User deleted successfully']);
            return Redirect::back();
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }


    public function get_user(Request $request)
    {
        $userID = $request->input('userID');
        $user = User_Model::find($userID);

        // $encryptedUserPwd = Crypt::decryptString($user->user_pwd);
        $encryptedUserPwd = $user->user_pwd;
        if ($user) {
            // Return the latitude and longitude as a JSON response
            return response()->json([
                'user_id' => $userID,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'user_name' => $user->user_name,
                'user_password' => $encryptedUserPwd,
                'user_image' => $user->user_image
            ]);
        } else {
            // Handle the case when the mark is not found
            return response()->json(['error' => 'User not found'], 404);
        }
    }




    public function reset_user(Request $request)
    {
        // Delete all records from the tb_mark table
        User_Model::query()->delete();

        // Reset the auto-increment value
        DB::statement('ALTER TABLE tb_users AUTO_INCREMENT = 1');

        // Redirect back to the previous page
        return redirect()->back();
    }






    ///////////////////////////// PAGE TITLE & URL SETTER ////////////////////////////
    public function setPageSession($pageTitle, $pageUrl)    // Param1 = page title, Param2 = page url !
    {
        $pageData = Session::get('page');
        $pageData['page_title'] = $pageTitle;
        $pageData['page_url'] = $pageUrl;

        // Store the updated array back in the session
        Session::put('page', $pageData);
        return true;
    }
    public function setReturnView($viewurl, $loadUsersFromDB = [])
    {
        $pageData = Session::get('page');
        $mergedData = array_merge($loadUsersFromDB, ['pageData' => $pageData]);
        return view($viewurl, $mergedData);
    }
}
