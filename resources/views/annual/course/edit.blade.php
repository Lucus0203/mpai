@extends('layouts.app')

@section('content')
    <script src="{{URL::asset('js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            $('#courseform').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: {
                    title: {
                        required: true
                    },
                    price:{
                        required: true,
                        digits:true
                    },
                    day:{
                        required: true,
                        digits:true
                    }
                },
                messages: {
                    title: {
                        required: "请输入课程标题"
                    },
                    price:{
                        required: "请输入价格",
                        digits:"必须是整数"
                    },
                    day:{
                        required: "请输入天数",
                        digits:"必须是整数"
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
        });
    </script>
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-i fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">课程信息</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    课程信息
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
                        {{Form::open(['method'=>'PATCH','url'=>'/annual/course/'.$course->id,'class'=>'form-horizontal','role'=>'form','id'=>'courseform'])}}
                            <div class="form-group">
                                {{ Form::label('type_id', '类型', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-2">
                                    {{ Form::select('type_id', $types, $course->type_id, array('class' => 'form-control','id'=>'type_id')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('price', '价格', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-2">
                                    {{ Form::text('price',$course->price,['class'=>'form-control','placeholder'=>'请输入价格','id'=>'price']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('day', '天数', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-2">
                                    {{ Form::text('day',$course->day,['class'=>'form-control','placeholder'=>'请输入天数','id'=>'day']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('title', '课程标题', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-9">
                                    {{ Form::text('title',$course->title,['class'=>'form-control','placeholder'=>'请输入标题','id'=>'title']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('info', '课程收益', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('info',$course->info,['class'=>'form-control','placeholder'=>'请输入课程收益','id'=>'info']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('target', '目标对象', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('target',$course->target,['class'=>'form-control','placeholder'=>'请输入目标对象','id'=>'target']) }}
                                </div>
                            </div>
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-4 col-md-9">
                                    <button class="btn btn-info" type="submit">
                                        <i class="icon-ok bigger-110"></i>
                                        确定
                                    </button>
                                    <a href="/annual/course">
                                        <button class="btn btn-info" type="button">
                                            <i class="icon-ok bigger-110"></i>
                                            返回
                                        </button>
                                    </a>
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