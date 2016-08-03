<?php

namespace App\Http\Controllers;


class LoginpaiController extends Controller
{
    //
    public function redirectToPai($userid){
        $admin=\Auth::user();
        $admin->login_token=str_random(40);
        $admin->save();
        $url=env('WEB_SITE').'Login/fromauth/'.$userid.'/'.$admin->login_token;
        return redirect($url);
    }
}
