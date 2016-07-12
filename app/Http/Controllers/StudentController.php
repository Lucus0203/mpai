<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Requests;

class StudentController extends Controller
{
    //
    public function index(Request $request){
        $keyword = $request->input('keyword');

        $students=DB::table('pai_student as student')
            ->select('student.id','student.user_name','student.name','student.sex','student.job_name','student.mobile','student.email','student.role','company.name as companyname','parent_department.name as parent_departmentname','department.name as departmentname')
            ->leftJoin('pai_company as company','company.code','=','student.company_code')
            ->leftJoin('pai_department as parent_department','student.department_parent_id','=','parent_department.id')
            ->leftJoin('pai_department as department','student.department_id','=','department.id')
            ->where('student.isdel','=','2')
            ->where(function($query) use ($keyword){
                if(!empty($keyword)){
                    $query->where('student.name','like','%'.$keyword.'%')
                        ->orWhere('student.email','like','%'.$keyword.'%')
                        ->orWhere('student.mobile','like','%'.$keyword.'%')
                        ->orWhere('company.name','like','%'.$keyword.'%');
                }
            })
            ->orderBy('student.id','desc')->paginate(5);
        return view('student.list',compact('students','keyword'));
    }
}
