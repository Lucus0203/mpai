<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class CompanyController extends Controller
{
    //
    public function index(Request $request){
        $keyword = $request->input('keyword');

        $companys=DB::table('pai_company as company')
            ->select('company.id','company.code','company.name','company.logo','company.contact','company.mobile','company.tel','company.email','user.user_name','user.created','parent_industry.name as parent_industry_name','industry.name as industry_name','loginlog.created as logintime')
            ->leftJoin('pai_user as user',function($join){
                $join->on('company.code','=','user.company_code')->where('user.role','=','1');
            })
            ->leftJoin('pai_industries as parent_industry','company.industry_parent_id','=','parent_industry.id')
            ->leftJoin('pai_industries as industry','company.industry_id','=','industry.id')
            ->leftJoin('pai_user_login_log as loginlog',function($join){
                $join->on('loginlog.user_id','=','user.id');
            })
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
        return view('company.list',compact('companys','keyword'));
    }

    public function failusers(){
        $users=DB::table('pai_user as user')
            ->select('mobile','mobile_code','created','updated')
            ->where('user_name','=',null)
            ->orWhere('user_name','=','')
            ->orderBy('id','desc')->paginate(20);
        return view('company.failusers',compact('users'));
    }
}
