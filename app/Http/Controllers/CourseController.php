<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Requests;

class CourseController extends Controller
{
    //
    public function index(Request $request){
        $keyword = $request->input('keyword');

        $courses=DB::table('pai_course as course')
            ->select('course.id','course.title','course.address','course.time_start','course.time_end','company.name as companyname','teacher.name as teachername','course.price',DB::raw('count(applylist.student_id) as apply_count'))
            ->leftJoin('pai_company as company','company.code','=','course.company_code')
            ->leftJoin('pai_teacher as teacher','teacher.id','=','course.teacher_id')
            ->leftJoin('pai_course_apply_list as applylist','applylist.course_id','=','course.id')
            ->where('course.isdel','=','2')
            ->where(function($query) use ($keyword){
                if(!empty($keyword)){
                    $query->where('course.title','like','%'.$keyword.'%')
                        ->orWhere('course.address','like','%'.$keyword.'%')
                        ->orWhere('company.name','like','%'.$keyword.'%');
                }
            })
            ->groupBy('course.id')
            ->orderBy('course.id','desc')->paginate(20);
        return view('course.list',compact('courses','keyword'));
    }
}
