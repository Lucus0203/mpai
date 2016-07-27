<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CompanyController extends Controller
{
    //
    public function index(Request $request){
        $keyword = $request->input('keyword');
        $companys=DB::table('pai_company as company')
            ->select('company.id','company.code','company.name','company.logo','company.contact','company.mobile','company.tel','company.email','user.user_name','user.created','parent_industry.name as parent_industry_name','industry.name as industry_name')
            ->leftJoin('pai_user as user',function($join){
                $join->on('company.code','=','user.company_code')->where('user.role','=','1');
            })
            ->leftJoin('pai_industries as parent_industry','company.industry_parent_id','=','parent_industry.id')
            ->leftJoin('pai_industries as industry','company.industry_id','=','industry.id')
            ->where(function($query) use ($keyword){
                if(!empty($keyword)){
                    $query->where('company.name','like','%'.$keyword.'%')
                        ->orWhere('company.contact','like','%'.$keyword.'%')
                        ->orWhere('company.mobile','like','%'.$keyword.'%')
                        ->orWhere('company.email','like','%'.$keyword.'%');
                }
            })
            ->orderBy('company.code','desc')->groupBy('user.id')->paginate(20);
        return view('company.list',compact('companys','keyword'));
    }

    public function failusers(){
        $users=DB::table('pai_user as user')
            ->select('id','mobile','mobile_code','created','updated')
            ->where('user_name','=',null)
            ->orWhere('user_name','=','')
            ->orderBy('id','desc')->paginate(20);
        return view('company.failusers',compact('users'));
    }

    public function deluser($uid){
        User::destroy($uid);
        return Redirect::to('/company/failusers');
    }

    public function userlist(Request $request){
        $keyword = $request->input('keyword');
        $users=DB::table('pai_user as user')
            ->select('user.id','company.code as company_code','company.name as company_name','user.user_name','user.real_name','user.mobile','user.tel','user.email','user.role','user.created',DB::raw('max(loginlog.created) as logintime'),DB::raw('max(actionlog.created) as actiontime'))
            ->leftJoin('pai_company as company','company.code','=','user.company_code')
            ->leftJoin('pai_user_action_log as actionlog','actionlog.user_id','=','user.id')
            ->leftJoin('pai_user_login_log as loginlog','loginlog.user_id','=','user.id')
            ->where(function($query) use ($keyword){
                if(!empty($keyword)){
                    $query->where('company.name','like','%'.$keyword.'%')
                        ->orWhere('company.contact','like','%'.$keyword.'%')
                        ->orWhere('company.mobile','like','%'.$keyword.'%')
                        ->orWhere('company.email','like','%'.$keyword.'%');
                }
            })
            ->orderBy('loginlog.created','desc')
            ->orderBy('company.code','desc')->groupBy('user.id')->paginate(20);
        return view('company.userlist',compact('users','keyword'));
    }
}
