<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todaycount=DB::table('pai_user')->whereBetween('created',[Carbon::today(),Carbon::tomorrow()])->count();
        $weekcount=DB::table('pai_user')->whereBetween('created',[new Carbon('last monday'),Carbon::tomorrow()])->count();
        $lastmonthday=new Carbon('first day of this month');
        $lastmonthday = $lastmonthday->toDateString().' 00:00:00';
        $monthcount=DB::table('pai_user')->whereBetween('created',[$lastmonthday,Carbon::tomorrow()])->count();
        $failcount=DB::table('pai_user')->where('user_name','=','')->orWhere('user_name','=',null)->count();
        return view('home',compact('todaycount','weekcount','monthcount','failcount'));
    }
}
