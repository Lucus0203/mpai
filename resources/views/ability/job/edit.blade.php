@extends('layouts.app')

@section('content')
    <script src="{{URL::asset('js/ace-extra.min.js')}}"></script>
    <script src="{{URL::asset('js/chosen.jquery.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            $('#jobform').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: {
                    name: {
                        required: true
                    },
                    'standard1[]':{
                        required: true,
                        digits:true
                    },
                    'standard2[]':{
                        required: true,
                        digits:true
                    },
                    'standard3[]':{
                        required: true,
                        digits:true
                    },
                    'standard4[]':{
                        required: true,
                        digits:true
                    },
                    'standard5[]':{
                        required: true,
                        digits:true
                    },
                    'model1[]':{
                        required: true
                    },
                    'model2[]':{
                        required: true
                    },
                    'model3[]':{
                        required: true
                    },
                    'model4[]':{
                        required: true
                    },
                    'model5[]':{
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "请输入岗位名称"
                    },
                    'standard1[]':{
                        required: "专业能力等级标准不能为空",
                        digits:"必须是整数"
                    },
                    'standard2[]':{
                        required: "通用能力等级标准不能为空",
                        digits:"必须是整数"
                    },
                    'standard3[]':{
                        required: "领导力力等级标准不能为空",
                        digits:"必须是整数"
                    },
                    'standard4[]':{
                        required: "个性等级标准不能为空",
                        digits:"必须是整数"
                    },
                    'standard5[]':{
                        required: "经验等级标准不能为空",
                        digits:"必须是整数"
                    },
                    'model1[]':{
                        required: "请选择专业能力"
                    },
                    'model2[]':{
                        required: "请选择通用能力"
                    },
                    'model3[]':{
                        required: "请选择领导力"
                    },
                    'model4[]':{
                        required: "请选择个性"
                    },
                    'model5[]':{
                        required: "请选择经验"
                    }
                },
                highlight: function (e) {
                    $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                },
                success: function (e) {
                    $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
                    $(e).remove();
                },
                invalidHandler: function (form) {
                }
            });
            $('#type-select').change(function(){
                if($(this).val()==1){
                    $('#company_wrap').hide();
                    $('#parent_industries_wrap,#industries_wrap').show();
                }else{
                    $('#company_wrap').show();
                    $('#parent_industries_wrap,#industries_wrap').hide();
                }
            });
            $('#industry_parent_id').change(function(){
                var parentid=$(this).val();
                var str='<option value="">全部</option>';
                if($.trim(parentid)!='') {
                    $.ajax({
                        url: '/ajax/industries/' + parentid,
                        async: false,
                        success: function (res) {
                            $.each(res, function (key, val) {
                                str += '<option value="' + val.id + '">' + val.name + '</option>';
                            });
                        }
                    });
                }
                $('#industry_id').html(str);
            });
            $('.btn-model-type').click(function () {
                var type = $('.btn-model-type').index($(this))+1;
                var opts='';
                $.ajax({
                    url:'/ability/model/getmodelbytype/'+type,
                    async: false,
                    dataType:'json',
                    success:function(res){
                        $.each( res, function( key,val ) {
                            val.note=($.trim(val.note)!='')?'('+val.note+')':'';
                            opts+='<option value="'+val.id+'">'+val.code+val.name+val.note+'</option>';
                        });
                    }
                });
                var str='<div class="form-group">' +
                        '<label class="col-sm-1 control-label no-padding-left red model-select-remove"><i class="icon-remove fa fa-remove"></i></label>' +
                        '<input type="text" class="col-sm-1 control-label center " placeholder="等级标准" value="" name="standard'+type+'[]" />'+
                        '<div class="col-sm-9">' +
                        '<select name="model'+type+'[]" class="chosen-select col-xs-10 col-sm-5 model-select" >' +
                        '<option value="" selected >选择能力</option>' +
                        opts +
                        '</select><p class="help-inline col-xs-12 model-info"></p>' +
                        '</div>' +
                        '</div>';
                $('#type'+type).append(str);
                $('.model-select-remove').click(function(){$(this).parent().remove();});
                $(".model-select").chosen({search_contains: true,disable_search_threshold: 10}).change(function(){
                    var mid=$(this).val();
                    var obj = [];
                    var levelinfo = '';
                    var levelinfoindex=1;
                    $.ajax({
                        url:'/ability/model/getmodelbyid/'+mid,
                        async: false,
                        success:function(res){
                            $.each( res, function( key,val ) {
                                obj[key]=val;
                                if(key.indexOf('level_info')!=-1&&$.trim(val)!=''){
                                    levelinfo+='<br>'+'描述'+levelinfoindex+':'+val;
                                    levelinfoindex++;
                                }
                            });
                        }
                    });
                    $(this).parent().find('.model-info').html('<span class="col-sm-6 middle">能力描述:'+obj.info+'</span><span class="col-sm-6 middle">级数:'+obj.level+','+levelinfo+'</span>');
                });
            });
            $(".chosen-select").chosen({search_contains: true,disable_search_threshold: 10});
            if($('#type-select').val()==1){
                $('#company_wrap').hide();
                $('#parent_industries_wrap,#industries_wrap').show();
            }else{
                $('#company_wrap').show();
                $('#parent_industries_wrap,#industries_wrap').hide();
            }
            $('.model-select-remove').click(function(){$(this).parent().remove();});
        });
    </script>
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-i fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">编辑岗位</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    编辑岗位
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="icon-remove fa fa-remove"></i>
                                </button>
                                @foreach ($errors->all() as $error)
                                    <strong>
                                        <i class="icon-remove fa fa-remove"></i>
                                    </strong>
                                    {{ $error }}
                                    <br/>
                                @endforeach
                            </div>
                        @endif
                        @if(Session::get('success')=='ok')
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="icon-ok fa fa-remove"></i>
                                </button>
                                <strong>
                                    <i class="icon-remove fa fa-check"></i>
                                    保存成功
                                </strong>
                                <br />
                            </div>
                        @endif
                        {{Form::open(['method'=>'PATCH','url'=>'/ability/job/'.$job->id,'class'=>'form-horizontal','role'=>'form','id'=>'jobform'])}}
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="info">岗位名</label>
                            <div class="col-sm-3">
                                {{ Form::text('name',$job->name,['class'=>'form-control','id'=>'name']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="type-select">类型</label>
                            <div class="col-sm-2">
                                {{ Form::select('type', array('1'=>'通用岗位','2'=>'定制岗位'), $job->type, array('class' => 'form-control','id'=>'type-select')) }}
                            </div>
                        </div>
                        <div class="form-group" id="company_wrap">
                            <label class="col-sm-1 control-label no-padding-right" for="company_code">所属公司</label>
                            <div class="col-sm-4">
                                <select name="company_code" class="width-80 chosen-select" id="company_code" >
                                    <option value="" selected>全部</option>
                                    @foreach($company as $c)
                                        <option value="{{$c->code}}" @if($job->company_code == $c->code)
                                                selected
                                                @endif >{{$c->code}} {{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="parent_industries_wrap">
                            <label class="col-sm-1 control-label no-padding-right" for="industry_parent_id">行业</label>
                            <div class="col-sm-2">
                                <select name="industry_parent_id" class="form-control" id="industry_parent_id">
                                    <option value="" selected >全部</option>
                                    @foreach($parent_industries_list as $indus)
                                        <option value="{{$indus->id}}" @if($job->industry_parent_id == $indus->id)
                                        selected
                                        @endif  >{{$indus->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="industries_wrap">
                            <label class="col-sm-1 control-label no-padding-right" for="industry_id">领域</label>
                            <div class="col-sm-2">
                                <select name="industry_id" class="form-control" id="industry_id">
                                    <option value="" selected >全部</option>
                                    @foreach($industries_list as $ind)
                                        <option value="{{$ind->id}}" @if($job->industry_id == $ind->id)
                                        selected
                                        @endif  >{{$ind->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-group">
                                <label class="col-sm-1 control-label no-padding-right">状态</label>
                                <div class="col-sm-2 radio">
                                    <label>
                                        {{Form::radio('status','2',$job->status==2,['class'=>'ace'])}}
                                        <span class="lbl">不发布</span>
                                    </label>
                                    <label>
                                        {{Form::radio('status','1',$job->status==1,['class'=>'ace'])}}
                                        <span class="lbl">发布</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @for($modindex=1;$modindex<6;$modindex++)
                            <div class="hr hr-18 hr-dotted"></div>
                            <h2><small>
                                    @if($modindex==1)
                                        专业能力
                                    @elseif($modindex==2)
                                        通用能力
                                    @elseif($modindex==3)
                                        领导力
                                    @elseif($modindex==4)
                                        个性
                                    @elseif($modindex==5)
                                        经验
                                    @endif
                                </small></h2>
                            <div id="type{{$modindex}}">
                                @foreach($jobmodels['model'.$modindex] as $jm)
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-left red model-select-remove"><i class="icon-remove fa fa-remove"></i></label>
                                        <input type="text" class="col-sm-1 control-label center " placeholder="等级标准" value="{{$jm->level_standard}}" name="standard{{$modindex}}[]" />
                                        <div class="col-sm-9">
                                            <select name="model{{$modindex}}[]" class="chosen-select col-sm-5 model-select" >'
                                                <option value="" >选择能力</option>
                                                @foreach($abilitymodels['model'.$modindex] as $am)
                                                    <option value="{{$am->id}}" @if($jm->code==$am->code)
                                                        selected
                                                    @endif >{{$am->code}}{{$am->name}}{{!empty($am->note)?'('.$am->note.')':''}}</option>
                                                @endforeach
                                            </select><p class="help-inline col-xs-12 model-info"><span class="col-sm-6 middle">能力描述:{{$jm->info}}</span><span class="col-sm-6 middle">级数:{{$jm->level}},
                                                    {!! (!empty($jm->level_info1))?'<br>描述1:'.$jm->level_info1:'' !!}
                                                    {!! (!empty($jm->level_info2))?'<br>描述2:'.$jm->level_info2:'' !!}
                                                    {!! (!empty($jm->level_info3))?'<br>描述3:'.$jm->level_info3:'' !!}
                                                    {!! (!empty($jm->level_info4))?'<br>描述4:'.$jm->level_info4:'' !!}
                                                    {!! (!empty($jm->level_info5))?'<br>描述5:'.$jm->level_info5:'' !!}
                                                    {!! (!empty($jm->level_info6))?'<br>描述6:'.$jm->level_info6:'' !!}
                                                    {!! (!empty($jm->level_info7))?'<br>描述7:'.$jm->level_info7:'' !!}
                                                    {!! (!empty($jm->level_info8))?'<br>描述8:'.$jm->level_info8:'' !!}
                                                    {!! (!empty($jm->level_info9))?'<br>描述9:'.$jm->level_info9:'' !!}
                                                    {!! (!empty($jm->level_info10))?'<br>描述10:'.$jm->level_info10:'' !!}
                                                    </span></p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="btn btn-info btn-model-type" type="button">
                                <i class="icon-ok bigger-110"></i>
                                添加
                            </button>
                        @endfor

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-4 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="icon-ok bigger-110"></i>
                                    确定
                                </button>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div><!-- /row -->

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
@endsection