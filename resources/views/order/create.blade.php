@extends('layouts.app')

@section('content')
    <div class="breadcrumbs" id="breadcrumbs">
        <link rel="stylesheet" href="{{URL::asset('css/bootstrap-datetimepicker.min.css')}}"/>
        <script src="{{URL::asset('js/ace-extra.min.js')}}"></script>
        <script src="{{URL::asset('js/chosen.jquery.min.js')}}"></script>
        <script src="{{URL::asset('js/date-time/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{URL::asset('js/date-time/bootstrap-timepicker.min.js')}}"></script>
        <script src="{{URL::asset('js/date-time/bootstrap-datetimepicker.min.js')}}"></script>
        <script src="{{URL::asset('js/jquery.validate.min.js')}}"></script>
        <script type="text/javascript">
            jQuery(function ($) {
                $('#orderform').validate({
                    errorElement: 'div',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules: {
                        company_code: {
                            required: true
                        },
                        use_num: {
                            required: true,
                            digits:true
                        },
                        cost: {
                            required: true,
                            digits:true
                        }
                    },

                    messages: {
                        company_code: {
                            required: "请选择公司"
                        },
                        use_num: {
                            required: "请输入次数",
                            digits:"请输入整数"
                        },
                        cost: {
                            required: "请输入费用",
                            digits:"请输入整数"
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
                $('#datetimepicker1,#datetimepicker2').datetimepicker({pickTime: false});
                $(".chosen-select").chosen({search_contains: true,disable_search_threshold: 10});
            });
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-i fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">添加企业功能</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    添加企业功能
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
                        {{Form::open(['url'=>'/order','class'=>'form-horizontal','role'=>'form','id'=>'orderform'])}}
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="company_code">公司企业</label>
                            <div class="col-sm-4">
                                <select name="company_code" class="width-80 chosen-select" id="company_code" >
                                    <option value="" selected>全部</option>
                                    @foreach($company as $c)
                                        <option value="{{$c->code}}" >{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="module">模块</label>
                            <div class="col-sm-2">
                                {{ Form::select('module', array('ability'=>'能力模型'), null, array('class' => 'form-control','id'=>'module')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="features">功能</label>
                            <div class="col-sm-2">
                                <select name="features_id" class="form-control" id="features">
                                    <option value="0">全部</option>
                                    @foreach($features as $f)
                                        <option value="{{$f->id}}">{{$f->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="years">年限</label>
                            <div class="col-sm-2">
                                {{ Form::select('years', ['0'=>'永久','1'=>'1年','2'=>'2年','3'=>'3年','4'=>'4年','5'=>'5年'], null, array('class' => 'form-control','id'=>'years')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="use_num">功能次数</label>
                            <div class="col-sm-2">
                                {{ Form::text('use_num', null, ['class' => 'form-control','id'=>'use_num','placeholder'=>'0则不限']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="cost">费用</label>
                            <div class="col-sm-2">
                                {{ Form::text('cost', null, ['class' => 'form-control','id'=>'cost','placeholder'=>'正整数']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="paid_time">付费时间</label>
                            <div class="col-sm-2">
                                <div class="input-group input-append date" id="datetimepicker1">
                                    {{ Form::text('paid_time', null, ['data-format'=>'yyyy-MM-dd hh:mm:ss','id'=>'paid_time','class'=>'form-control']) }}
                                    <span class="input-group-addon add-on">
                                        <i data-time-icon="icon-time" data-date-icon="icon-calendar fa fa-calendar fa-lg"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-group">
                                <label class="col-sm-1 control-label no-padding-right">付费状态</label>
                                <div class="col-sm-2 radio">
                                    <label>
                                        {{Form::radio('paid_status','1',true,['class'=>'ace'])}}
                                        <span class="lbl">未付</span>
                                    </label>
                                    <label>
                                        {{Form::radio('paid_status','2',false,['class'=>'ace'])}}
                                        <span class="lbl">已付</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="start_time">开始时间</label>
                            <div class="col-sm-2">
                                <div class="input-group input-append date" id="datetimepicker2">
                                    {{ Form::text('start_time', null, ['data-format'=>'yyyy-MM-dd hh:mm:ss','id'=>'start_time','class'=>'form-control']) }}
                                    <span class="input-group-addon add-on">
                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar fa fa-calendar fa-lg"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-group">
                                <label class="col-sm-1 control-label no-padding-right">审核</label>
                                <div class="col-sm-2 radio">
                                    <label>
                                        {{Form::radio('checked','1',true,['class'=>'ace'])}}
                                        <span class="lbl">通过</span>
                                    </label>
                                    <label>
                                        {{Form::radio('checked','2',false,['class'=>'ace'])}}
                                        <span class="lbl">待审核</span>
                                    </label>
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