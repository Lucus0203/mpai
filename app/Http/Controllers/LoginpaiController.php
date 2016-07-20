<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Admin;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class LoginpaiController extends Controller
{
    //
    public function redirectToPai($userid){
        $admin=\Auth::user();
        echo 1;
        $admin->login_token=str_random(40);
        $admin->save();
        $url=env('WEB_SITE').'Login/fromauth/'.$userid.'/'.$admin->login_token;
        return Redirect::to($url);
    }
}
