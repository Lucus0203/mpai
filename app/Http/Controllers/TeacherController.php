<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Requests;

class TeacherController extends Controller
{
    //
    public function index(Request $request){
        $keyword = $request->input('keyword');

        $teachers=DB::table('pai_teacher as teacher')
            ->select('teacher.id','teacher.name','teacher.type','teacher.head_img','teacher.title','teacher.specialty','teacher.years','teacher.hourly','company.name as companyname')
            ->leftJoin('pai_company as company','company.code','=','teacher.company_code')
            ->where('teacher.isdel','=','2')
            ->where(function($query) use ($keyword){
                if(!empty($keyword)){
                    $query->where('teacher.name','like','%'.$keyword.'%')
                        ->orWhere('teacher.title','like','%'.$keyword.'%')
                        ->orWhere('teacher.specialty','like','%'.$keyword.'%')
                        ->orWhere('company.name','like','%'.$keyword.'%');
                }
            })
            ->orderBy('teacher.id','desc')->paginate(20);
        return view('teacher.list',compact('teachers','keyword'));
    }
}
