<?php

namespace App\Http\Controllers;

use App\AnnualCourseLibrary;
use App\AnnualCourseLibraryType;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use PHPExcel_IOFactory;

class AnnualSurveyController extends Controller
{
    //
    public function index(Request $request){

    }

    public function course(Request $request){
        $keyword = $request->input('keyword');
        $search_type = $request->input('search_type');

        $courses=DB::table('pai_annual_course_library as course')
            ->select('course.id','course.title','course.type_id','course.info','course.target','course.price','course.day','course.created','course_type.name as course_type_name')
            ->leftJoin('pai_annual_course_library_type as course_type','course.type_id','=','course_type.id')
            ->where(function($query) use ($keyword){
                if(!empty($keyword)){
                    $query->where('course.title','like','%'.$keyword.'%')
                        ->orWhere('course.info','like','%'.$keyword.'%');
                }
            })
            ->where(function($query) use ($search_type) {
                if(!empty($search_type)){
                    $query->where('type_id','=',$search_type);
                }
            })
            ->groupBy('course.id')
            ->orderBy('course.id','desc')->paginate(20);
        //课程库类型
        $courstypes=AnnualCourseLibraryType::all();
        $types=array(''=>'全部');
        foreach ($courstypes as $t){
            $types[$t['id']]=$t['name'];
        }

        return view('annual.course.index',compact('keyword','courses','types','search_type'));
    }

    public function courseImport(){
        return view('annual.course.import');
    }

    public function courseUpload(Request $request){
        $ext=$request->file('excel')->extension();
        $path = $request->file('excel')->move(base_path().'/resources/uploads/annualCourse/',date('YmdHis').'.'.$ext);
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        $sheetCount = $objPHPExcel->getSheetCount();
        $msg=array();
        for($sheetindex=0;$sheetindex<$sheetCount;$sheetindex++){
            $sheet = $objPHPExcel->setActiveSheetIndex($sheetindex);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestCol = $sheet->getHighestColumn(); // 取得总列数
            $sheetname=$objPHPExcel->getActiveSheet()->getTitle();
            $coursetype=AnnualCourseLibraryType::firstOrCreate(['name'=>$sheetname]);

            $sheetNo = $sheetindex+1;
//            if($highestCol=='E') {
                $course=array();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $course['title'] = trim($objPHPExcel->getActiveSheet()->getCell('A' . $row)->getValue());//标题
                    $course['info'] = trim($objPHPExcel->getActiveSheet()->getCell('B' . $row)->getValue());//收益
                    $course['target'] = trim($objPHPExcel->getActiveSheet()->getCell('C' . $row)->getValue());//对象
                    $course['price'] = trim($objPHPExcel->getActiveSheet()->getCell('D' . $row)->getValue());//价格
                    $course['day'] = trim($objPHPExcel->getActiveSheet()->getCell('E' . $row)->getValue());//天数
                    $course['type_id'] = $coursetype->id;//级别1描述
                    if(empty($course['title'])){
                        $msg[]='第'.$sheetNo.'工作簿'.$row.'行,第A列的课程为空';
                    }else{
                        AnnualCourseLibrary::create($course);
                    }

                }
//            }else{
//                $msg[]='第'.$sheetindex.'工作簿导入失败,导入数据列不正确';
//            }
        }
        unlink($path);
        return redirect('annual/course/import')->with('success','ok')->withErrors($msg);
    }

    public function courseCreate(){
        $courstypes=AnnualCourseLibraryType::all();
        $types=array();
        foreach ($courstypes as $t){
            $types[$t['id']]=$t['name'];
        }
        return view('annual.course.create',compact('types'));
    }

    public function courseStore(Requests\AnnualCourseLibrary $request){
        $input = $request->all();
        AnnualCourseLibrary::create($input);
        return redirect('annual/course')->with('success','ok');
    }

    public function courseEdit($courseid){
        $course=AnnualCourseLibrary::findOrFail($courseid);
        $courstypes=AnnualCourseLibraryType::all();
        $types=array();
        foreach ($courstypes as $t){
            $types[$t['id']]=$t['name'];
        }
        return view('annual.course.edit',compact('course','types'));
    }

    public function courseUpdate(Requests\AnnualCourseLibrary $request,$courseid){
        $course=AnnualCourseLibrary::findOrFail($courseid);
        $course->update($request->all());
        return back()->with('success','ok');
    }

    public function courseDestroy($courseid){
        AnnualCourseLibrary::destroy($courseid);
        return back();
    }

    public function courseType(){
        //$types=AnnualCourseLibraryType::all();
        $coursetypes=DB::table('pai_annual_course_library_type as library_type')
            ->select('library_type.id','library_type.name','library_type.ispublic','library_type.created',DB::raw('count(course_library.id) as course_count'))
            ->leftJoin('pai_annual_course_library as course_library','course_library.type_id','=','library_type.id')
            ->groupBy('library_type.id')
            ->orderBy('library_type.id','asc')->get();
        return view('annual.course.type',compact('coursetypes'));
    }


    public function courseTypeCreate(){
        return view('annual.course.typecreate');
    }

    public function courseTypeStore(Request $request){
        $input = $request->all();
        AnnualCourseLibraryType::create($input);
        return redirect('annual/coursetype')->with('success','ok');
    }

    public function courseTypeEdit($courseTypeId){
        $coursetype=AnnualCourseLibraryType::findOrFail($courseTypeId);
        return view('annual.course.typeedit',compact('coursetype'));
    }

    public function courseTypeUpdate(Request $request,$courseTypeId){
        $course=AnnualCourseLibraryType::findOrFail($courseTypeId);
        $course->update($request->all());
        return back()->with('success','ok');
    }

    public function courseTypeDestroy($courseTypeId){
        $count=DB::table('pai_annual_course_library as courses')->where('type_id','=',$courseTypeId)->count();
        if($count>0){
            $msg[]='此类型含有课程,不可删除';
            return redirect('annual/coursetype')->withErrors($msg);
        }else{
            AnnualCourseLibraryType::destroy($courseTypeId);
            return back();
        }
    }

    public function courseTypePublic($courseTypeId){
        $type=AnnualCourseLibraryType::findOrFail($courseTypeId);
        $type->ispublic=1;
        $type->update();
        return back()->with('success','ok');
    }
    public function courseTypeUnpublic($courseTypeId){
        $type=AnnualCourseLibraryType::findOrFail($courseTypeId);
        $type->ispublic=2;
        $type->update();
        return back()->with('success','ok');
    }

}
