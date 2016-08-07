<?php

namespace App\Http\Controllers;

use App\AbilityJob;
use App\Company;
use App\CompanyOrder;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index(Request $request){
        $keyword = $request->input('keyword');
        $orders=DB::table('pai_company_order as order')
            ->select('company.name as company_name','order.*')
            ->leftJoin('pai_company as company','company.code','=','order.company_code')
            ->where(function($query) use ($keyword){
                if(!empty($keyword)){
                    $query->where('company.name','like','%'.$keyword.'%')
                        ->orWhere('company.contact','like','%'.$keyword.'%')
                        ->orWhere('company.mobile','like','%'.$keyword.'%')
                        ->orWhere('company.email','like','%'.$keyword.'%')
                        ->orWhere('company.code','like','%'.$keyword.'%');
                }
            })
            ->orderBy('order.id','desc')->paginate(20);
        return view('order.index',compact('orders','keyword'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $company=Company::select('code','name')->get();
        $features=AbilityJob::select('id','name')->where('status',1)->get();
        return view('order.create',compact('company','features'));
    }

    /**
     * @param Requests\AbilityModelRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function store(Requests\CompanyOrderRequest $request){
        $input = $request->all();
        $input['use_num_remain']=$request->use_num;
        $input['created']=date("Y-m-d H:i:s");
        if(empty($input['paid_time'])){
            unset($input['paid_time']);
        }
        if(empty($input['start_time'])){
            unset($input['start_time']);
        }
        if($request->features_id==0){
            $input['features_name']='全部';
        }elseif($request->module=='ability'){
            $f=AbilityJob::find($request->features_id);
            $input['features_name']=$f->name;
        }
        CompanyOrder::create($input);
        return redirect('/order')->with('success','ok');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request,$id){
        $order=CompanyOrder::findOrFail($id);
        $company=Company::select('code','name')->get();
        $features=AbilityJob::select('id','name')->where('status',1)->get();
        return view('order.edit',compact('order','company','features'));
    }

    /**
     * @param Requests\AbilityModelRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\CompanyOrderRequest $request,$id){
        $order=CompanyOrder::findOrFail($id);
        $input = $request->all();
        if(empty($input['paid_time'])){
            unset($input['paid_time']);
        }
        if(empty($input['start_time'])){
            unset($input['start_time']);
        }
        if($request->features_id==0){
            $input['features_name']='全部';
        }elseif($request->module=='ability'){
            $f=AbilityJob::find($request->features_id);
            $input['features_name']=$f->name;
        }
        $order->update($input);

        return redirect()->back()->with('success','ok');
    }

    public function destroy($id){
        CompanyOrder::destroy($id);
        $msg['success']="ok";
        return back()->with($msg);
    }
    public function checked($id){
        $order=CompanyOrder::find($id);
        $order->checked=1;
        $order->save();
        $msg['success']="ok";
        return back()->with($msg);
    }
    public function unchecked($id){
        $order=CompanyOrder::find($id);
        $order->checked=2;
        $order->save();
        $msg['success']="ok";
        return back()->with($msg);
    }
}
