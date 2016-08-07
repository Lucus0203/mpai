@extends('layouts.app')

@section('content')
    <div class="breadcrumbs" id="breadcrumbs">
        <script src="{{URL::asset('js/jquery.validate.min.js')}}"></script>
        <script type="text/javascript">
            jQuery(function ($) {
                $('#modelform').validate({
                    errorElement: 'div',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules: {
                        name: {
                            required: true
                        }
                    },

                    messages: {
                        name: {
                            required: "请输入名称"
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
                $('.level_info .form-group:lt({{$level}})').show();
                $('#level').change(function(){
                    $('.level_info .form-group').hide();
                    $('.level_info .form-group:lt('+$('#level').val()+')').show();
                });
                $('#type').change(function(){
                    var type=$(this).val();
                    $.ajax({
                        url: '/ability/model/maxcode/'+type,
                        success: function (res) {
                            $('#code').val(res);
                        }
                    })
                });
            });
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-i fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">创建能力</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    创建能力
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
                        {{Form::open(['url'=>'/ability/model','class'=>'form-horizontal','role'=>'form','id'=>'modelform'])}}
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="type">类型</label>
                            <div class="col-sm-2">
                                {{ Form::select('type', $typeList, null, array('class' => 'form-control','id'=>'type')) }}
                            </div>
                            <label class="col-sm-1 control-label no-padding-right" for="code">编号</label>
                            <div class="col-sm-2">
                                {{ Form::text('code',$code,['class'=>'form-control col-xs-12','readonly'=>'readonly','id'=>'code']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="name">名称</label>
                            <div class="col-sm-2">
                                {{ Form::text('name',null,['class'=>'form-control col-xs-12','placeholder'=>'请输入名称','id'=>'name']) }}
                            </div>
                            <label class="col-sm-1 control-label no-padding-right" for="note">名称备注</label>
                            <div class="col-sm-2">
                                {{ Form::text('note',null,['class'=>'form-control col-xs-12','placeholder'=>'请输入名称备注','id'=>'name']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="info">能力描述</label>
                            <div class="col-sm-8">
                                {{ Form::textarea('info',null,['class'=>'autosize-transition form-control','id'=>'info','size' => '30x5']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="level">评级数</label>
                            <div class="col-sm-1">
                                {{ Form::select('level', $levels, $level, array('class' => 'form-control','id'=>'level')) }}
                            </div>
                        </div>
                        <div class="level_info">
                            <div class="form-group" style="display: none;">
                                <label class="col-sm-1 control-label no-padding-right" for="level_info1">级别1描述</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('level_info1',null,['class'=>'autosize-transition form-control','id'=>'level_info1','size' => '30x5']) }}
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="col-sm-1 control-label no-padding-right" for="level_info2">级别2描述</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('level_info2',null,['class'=>'autosize-transition form-control','id'=>'level_info2','size' => '30x5']) }}
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="col-sm-1 control-label no-padding-right" for="level_info3">级别3描述</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('level_info3',null,['class'=>'autosize-transition form-control','id'=>'level_info2','size' => '30x5']) }}
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="col-sm-1 control-label no-padding-right" for="level_info4">级别4描述</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('level_info4',null,['class'=>'autosize-transition form-control','id'=>'level_info2','size' => '30x5']) }}
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="col-sm-1 control-label no-padding-right" for="level_info6">级别5描述</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('level_info5',null,['class'=>'autosize-transition form-control','id'=>'level_info5','size' => '30x5']) }}
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="col-sm-1 control-label no-padding-right" for="level_info6">级别6描述</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('level_info6',null,['class'=>'autosize-transition form-control','id'=>'level_info6','size' => '30x5']) }}
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="col-sm-1 control-label no-padding-right" for="level_info7">级别7描述</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('level_info7',null,['class'=>'autosize-transition form-control','id'=>'level_info7','size' => '30x5']) }}
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="col-sm-1 control-label no-padding-right" for="level_info8">级别8描述</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('level_info8',null,['class'=>'autosize-transition form-control','id'=>'level_info8','size' => '30x5']) }}
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="col-sm-1 control-label no-padding-right" for="level_info9">级别9描述</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('level_info9',null,['class'=>'autosize-transition form-control','id'=>'level_info9','size' => '30x5']) }}
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="col-sm-1 control-label no-padding-right" for="level_info10">级别10描述</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('level_info10',null,['class'=>'autosize-transition form-control','id'=>'level_info10','size' => '30x5']) }}
                                </div>
                            </div>
                        </div>
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