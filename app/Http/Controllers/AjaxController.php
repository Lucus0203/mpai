<?php

namespace App\Http\Controllers;

use App\Industries;
use Illuminate\Http\Request;

use App\Http\Requests;

class AjaxController extends Controller
{
    //
    public function getIndustriesByParent($parent_id){
        $objs=Industries::select('id','name')->where('parent_id','=',$parent_id)->get();
        return response()->json($objs);
    }
}
