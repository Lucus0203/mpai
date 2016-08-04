<?php

namespace App\Http\Controllers;

use App\AbilityJob;
use App\AbilityModel;
use App\Company;
use App\Industries;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class AbilityJobController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $keyword = $request->input('keyword');
        $search_type = $request->input('search_type');
        $jobs = AbilityJob::where(function ($query) use ($keyword) {
                $query->Where('name','like',"%{$keyword}%");
            })
            ->where(function ($query) use ($search_type) {
                if(!empty($search_type)){
                    $query->where('type','=',$search_type);
                }
            })
            ->orderBy('id','desc')
            ->paginate(20);
        return view('ability.job.index',compact('jobs','keyword','search_type'));
    }

    public function create(){
        $parent_industries_list=Industries::whereNull('parent_id')->get();
        $company=Company::select('code','name')->get();
        return view('ability.job.create',compact('parent_industries_list','company'));
    }

    public function store(Request $request){
        $data['company_code']=$request->company_code;
        $data['type']=$request->type;
        $data['name']=$request->name;
        $data['industry_parent_id']=$request->industry_parent_id;
        $data['industry_id']=$request->industry_id;
        $data['created']=date("Y-m-d H:i:s");
        $job=AbilityJob::create($data);
        for ($i=1;$i<6;$i++) {
            $model = $request->input('model'.$i);
            if(!empty($model)){
                foreach ($model as $mid) {
                    DB::table('pai_ability_job_model')->insert(['job_id' => $job->id, 'model_id' => $mid,'created'=>date("Y-m-d H:i:s")]);
                }
            }
        }
        return redirect('/ability/job');
    }
    public function edit($id){
        $job=AbilityJob::find($id);
        $company=Company::select('code','name')->get();
        for ($i=1;$i<6;$i++){
            $jobmodels['model'.$i]=DB::table('pai_ability_model as ability_model')
                ->select('ability_job_model.id as ajmid','ability_model.code','ability_model.name','ability_model.info','ability_model.level','ability_model.level_info1','ability_model.level_info2','ability_model.level_info3','ability_model.level_info4','ability_model.level_info5','ability_model.level_info6','ability_model.level_info7','ability_model.level_info8','ability_model.level_info9','ability_model.level_info10')
                ->leftJoin('pai_ability_job_model as ability_job_model','ability_job_model.model_id','=','ability_model.id')
            ->where('ability_model.type','=',$i)
            ->where('ability_job_model.job_id','=',$id)->get();
            $abilitymodels['model'.$i] = AbilityModel::select('id','code','name')->where('type','=',$i)->get();
        }
        $parent_industries_list=Industries::whereNull('parent_id')->get();
        $industries_list=Industries::where('parent_id','=',$job->industry_parent_id)->get();
        return view('ability.job.edit',compact('job','company','jobmodels','abilitymodels','parent_industries_list','industries_list'));
    }
    public function update(Request $request,$id){
        $data['company_code']=$request->company_code;
        $data['type']=$request->type;
        $data['name']=$request->name;
        $data['industry_parent_id']=$request->industry_parent_id;
        $data['industry_id']=$request->industry_id;
        $job=AbilityJob::findOrFail($id);
        $job->update($data);
        DB::table('pai_ability_job_model')->where('job_id','=',$job->id)->delete();
        for ($i=1;$i<6;$i++) {
            $model = $request->input('model'.$i);
            if(!empty($model)){
                foreach ($model as $mid) {
                    DB::table('pai_ability_job_model')->insert(['job_id' => $job->id, 'model_id' => $mid,'created'=>date("Y-m-d H:i:s")]);
                }
            }
        }

        return redirect()->back()->with('success','ok');
    }
    public function destroy($id){
        AbilityJob::destroy($id);
        return redirect()->back()->with(array('success'=>'ok'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish($id){
        $job=AbilityJob::find($id);
        $job->status=1;
        $job->save();
        return redirect()->back()->with(array('success'=>'ok'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unpublish($id){
        $job=AbilityJob::find($id);
        $job->status=2;
        $job->save();
        return redirect()->back()->with(array('success'=>'ok'));
    }

}
