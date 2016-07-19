<?php

namespace App\Http\Controllers;

use App\User;
use App\UserActionLog;
use App\UserLoginLog;
use Illuminate\Http\Request;

use App\Http\Requests;

class LogController extends Controller
{
    //
    public function userlogin($userid){
        $user=User::find($userid);
        $logs=UserLoginLog::where('user_id','=',$userid)->paginate(20);
        return view('log/userlogin',compact('user','logs'));
    }

    public function useraction($userid){
        $user=User::find($userid);
        $logs=UserActionLog::where('user_id','=',$userid)->paginate(20);
        return view('log/useraction',compact('user','logs'));
    }
}
