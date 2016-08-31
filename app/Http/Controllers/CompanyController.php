<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use DB;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function index(Request $request){
        $keyword = $request->input('keyword');
        $companys=DB::table('pai_company as company')
            ->select('company.id','company.code','company.name','company.logo','company.contact','company.mobile','company.tel','company.email','company.note','company.updated','user.user_name','user.created','parent_industry.name as parent_industry_name','industry.name as industry_name')
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
                        ->orWhere('company.email','like','%'.$keyword.'%')
                        ->orWhere('company.code','like','%'.$keyword.'%');
                }
            })
            ->orderBy('company.code','desc')->groupBy('user.id')->paginate(20);
        return view('company.list',compact('companys','keyword'));
    }

    public function failusers(){
        $users=DB::table('pai_user as user')
            ->select('id','mobile','mobile_code','created','updated','ip_address')
            ->where('user_name','=',null)
            ->orWhere('user_name','=','')
            ->orderBy('id','desc')->paginate(20);
        return view('company.failusers',compact('users'));
    }

    public function deluser($uid){
        User::destroy($uid);
        return back();
    }

    public function userlist(Request $request){
        $keyword = $request->input('keyword');
        $users=DB::table('pai_user as user')
            ->select('user.id','company.code as company_code','company.name as company_name','user.user_name','user.real_name','user.mobile','user.tel','user.email','user.role','user.created','actionlog.created as actiontime')
            ->leftJoin('pai_company as company','company.code','=','user.company_code')
            ->leftJoin(DB::raw('(select user_id,created from `pai_user_action_log` group by user_id order by created desc ) as actionlog '),'actionlog.user_id','=','user.id')
            ->where(function($query) use ($keyword){
                if(!empty($keyword)){
                    $query->where('company.name','like','%'.$keyword.'%')
                        ->orWhere('company.contact','like','%'.$keyword.'%')
                        ->orWhere('company.mobile','like','%'.$keyword.'%')
                        ->orWhere('company.email','like','%'.$keyword.'%')
                        ->orWhere('company.code','like','%'.$keyword.'%');
                }
            })
            ->orderBy('actiontime','desc')
            ->groupBy('user.id')->paginate(20);
        return view('company.userlist',compact('users','keyword'));
    }

    public function edit($companyid){
        $company=Company::findOrFail($companyid);
        $user=User::where('company_code',$company['code'])->where('role',1)->first();
        return view('company.edit',compact('company','user'));
    }
    public function update(Request $request,$companyid){
        $company=Company::findOrFail($companyid);
        $company->note=$request->note;
        $company->update();
        return back()->with('success','ok');
    }
    public function updatenote(Request $request,$companyid){
        $company=Company::findOrFail($companyid);
        $company->note=$request->note;
        $company->update();
        return response()->json(array('success'=>'ok'));
    }

}
