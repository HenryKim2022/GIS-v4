<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login.show');
    // }

    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            $toast_message = ['You are not authorized to access that page. Please login first!'];
            Session::flash('auth_errors', $toast_message);

            return null;
        } else {
            $toast_message = ['You are not authorized to access that page. Please login first!'];
            Session::flash('auth_errors', $toast_message);
            $this->clearFlashMessages();
            return route('login.show');
        }
    }

    /**
     * Clear flash messages from the session.
     */
    protected function clearFlashMessages()
    {
        if (Session::has('flash.new')) {
            $flashMessages = Session::get('flash.new');
            foreach ($flashMessages as $key => $message) {
                Session::forget('flash.new.' . $key);
            }
        }
    }

}
