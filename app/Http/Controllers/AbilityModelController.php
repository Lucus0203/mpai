<?php

namespace App\Http\Controllers;

use App\AbilityModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AbilityModelUploadRequest;
use Illuminate\Support\Facades\DB;
use PHPExcel_IOFactory;

class AbilityModelController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $keyword = $request->input('keyword');
        $search_type = $request->input('search_type');
        $models = AbilityModel::where(function ($query) use ($keyword) {
            $query->where('code','like',"%{$keyword}%")
                ->orWhere('name','like',"%{$keyword}%")
                ->orWhere('info','like',"%{$keyword}%");
            })
            ->where(function ($query) use ($search_type) {
                if(!empty($search_type)){
                    $query->where('type','=',$search_type);
                }
            })
            ->orderBy('code','desc')
            ->paginate(20);
        return view('ability.model.index',compact('models','keyword','search_type'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        //1专业能力2通用能力3领导力4个性5经验
        $typeList=array('1'=>'专业能力','2'=>'通用能力','3'=>'领导力','4'=>'个性','5'=>'经验');
        $max = AbilityModel::where('type', 1)->max('code');
        $code=empty($max)?'1000001':$max+1;
        $levels=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
        $level=5;
        return view('ability.model.create',compact('typeList','levels','level','code'));
    }

    /**
     * @param Requests\AbilityModelRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function store(Requests\AbilityModelRequest $request){
        $input = $request->all();
        $input['created']=date("Y-m-d H:i:s");
        AbilityModel::create($input);
        return redirect('/ability/model')->with('success','ok');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request,$id){
        $model=AbilityModel::findOrFail($id);
        //1专业能力2通用能力3领导力4个性5经验
        $typeList=array('1'=>'专业能力','2'=>'通用能力','3'=>'领导力','4'=>'个性','5'=>'经验');
        $levels=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
        return view('ability.model.edit',compact('typeList','model','levels','level','code'));
    }

    /**
     * @param Requests\AbilityModelRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\AbilityModelRequest $request,$id){
        $model=AbilityModel::findOrFail($id);
        $model->update($request->all());

        return redirect()->back()->with('success','ok');
    }

    public function import(){
        return view('ability.model.import');
    }

    public function upload(AbilityModelUploadRequest $request){
        $ext=$request->file('excel')->extension();
        $path = $request->file('excel')->move(base_path().'/resources/uploads/abilitymodel/',date('YmdHis').'.'.$ext);
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        $sheetCount = $objPHPExcel->getSheetCount();
        $ability=array();
        $msg=array();
        for($sheetindex=0;$sheetindex<$sheetCount;$sheetindex++){
            $sheet = $objPHPExcel->setActiveSheetIndex($sheetindex);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestCol = $sheet->getHighestColumn(); // 取得总列数
            $sheetNo = $sheetindex+1;
            if($highestCol=='O') {
                for ($row = 2; $row <= $highestRow; $row++) {
                    $code = '';
                    $ability['type'] = trim($objPHPExcel->getActiveSheet()->getCell('A' . $row)->getValue());//类型
                    $code = trim($objPHPExcel->getActiveSheet()->getCell('B' . $row)->getValue());//编号存在则比较数据库更新或新增
                    $ability['name'] = trim($objPHPExcel->getActiveSheet()->getCell('C' . $row)->getValue());//能力名称
                    $ability['info'] = trim($objPHPExcel->getActiveSheet()->getCell('D' . $row)->getValue());//能力描述
                    $ability['level'] = trim($objPHPExcel->getActiveSheet()->getCell('E' . $row)->getValue());//级数
                    $ability['level_info1'] = trim($objPHPExcel->getActiveSheet()->getCell('F' . $row)->getValue());//级别1描述
                    $ability['level_info2'] = trim($objPHPExcel->getActiveSheet()->getCell('G' . $row)->getValue());//级别2描述
                    $ability['level_info3'] = trim($objPHPExcel->getActiveSheet()->getCell('H' . $row)->getValue());//级别3描述
                    $ability['level_info4'] = trim($objPHPExcel->getActiveSheet()->getCell('I' . $row)->getValue());//级别4描述
                    $ability['level_info5'] = trim($objPHPExcel->getActiveSheet()->getCell('J' . $row)->getValue());//级别5描述
                    $ability['level_info6'] = trim($objPHPExcel->getActiveSheet()->getCell('K' . $row)->getValue());//级别6描述
                    $ability['level_info7'] = trim($objPHPExcel->getActiveSheet()->getCell('L' . $row)->getValue());//级别7描述
                    $ability['level_info8'] = trim($objPHPExcel->getActiveSheet()->getCell('M' . $row)->getValue());//级别8描述
                    $ability['level_info9'] = trim($objPHPExcel->getActiveSheet()->getCell('N' . $row)->getValue());//级别9描述
                    $ability['level_info10'] = trim($objPHPExcel->getActiveSheet()->getCell('O' . $row)->getValue());//级别10描述
                    if(empty($ability['type'])){
                        $msg[]='第'.$sheetNo.'工作簿'.$highestRow.'行,第A列的类型为空';
                    }elseif(empty($ability['name'])){
                        $msg[]='第'.$sheetNo.'工作簿'.$highestRow.'行,第C列的能力名称为空';
                    }elseif(empty($ability['level'])){
                        $msg[]='第'.$sheetNo.'工作簿'.$highestRow.'行,第E列的级数为空';
                    }else{
                        if(empty($code)){
                            $max = AbilityModel::where('type', $ability['type'])->max('code');
                            $ability['code']=empty($max)?$ability['type'].'000001':$max+1;
                            $ability['created']=date("Y-m-d H:i:s");
                            AbilityModel::create($ability);
                        }else{
                            $model=AbilityModel::where('code',$code)->first();
                            if(!empty($model)){
                                $model->update($ability);
                            }else{
                                $msg[]='第'.$sheetNo.'工作簿'.$highestRow.'行,第B列的编号不存在更新数据失败';
                            }
                        }
                    }
                }
            }else{
                $msg[]='第'.$sheetindex.'工作簿导入失败,导入数据列不正确';
            }
        }
        unlink($path);
        return redirect('/ability/model/import')->with('success','ok')->withErrors($msg);
    }

    public function destroy($id){
        $num=DB::table('pai_ability_job_model')
            ->where('model_id','=',$id)
            ->count();
        if($num<=0){
            AbilityModel::destroy($id);
            $msg['success']="ok";
            return back()->with($msg);
        }else{
            $err[]="能力模型在使用中";
            return back()->withErrors($err);
        }
    }

    /**
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMaxCode($type){
        $max = AbilityModel::where('type', $type)->max('code');
        $maxcode=empty($max)?$type.'000001':$max+1;
        return response()->json($maxcode);
    }

    public function getModelsByType($type){
        $models = AbilityModel::select('id','code','name')->where('type','=',$type)->get();
        return response()->json($models);
    }

    public function getModelById($id){
        $model = AbilityModel::find($id);
        return response()->json($model);
    }


}
