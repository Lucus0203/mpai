<?php

namespace App\Http\Controllers\Admin;

use Admin;
use Auth;
use App\Http\Requests\Admin\ChangePassRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChangepassController extends Controller
{
    /**
     * @return mixed
     */
    public function index(){
        return view('auth.changepass');
    }

    public function changepass(ChangePassRequest $request){
        $user=Auth::user();
        if(Hash::check($request->oldpass,$user->password)){
            $user=\App\Admin::find(Auth::id());
            $user->password=bcrypt($request->newpass);
            $user->save();
            $res=array('success'=>true,'msg'=>'密码修改成功');
        }else{
            $res=array('success'=>false,'msg'=>'原密码不正确');
        }
        $res['act']='changepass';
        return view('auth.changepass',$res);
    }

    

}
