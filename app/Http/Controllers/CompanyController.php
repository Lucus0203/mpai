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
            ->select('company.id','company.code','company.name','company.logo','company.contact','company.mobile','company.tel','company.email','parent_industry.name as parent_industry_name','industry.name as industry_name')
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
            ->orderBy('code','desc')->paginate(20);
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
