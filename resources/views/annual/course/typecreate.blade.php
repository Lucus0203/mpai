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
                    name: {
                        required: true
                    }
                },
                messages: {
                    title: {
                        required: "请输入类型名称"
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
            <li class="active">课程类型编辑</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    课程类型编辑
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
                        {{Form::open(['method'=>'post','url'=>'/annual/coursetype/','class'=>'form-horizontal','role'=>'form','id'=>'courseform'])}}
                        <div class="form-group">
                            {{ Form::label('name', '名称', array('class' => 'col-sm-1 control-label')) }}
                            <div class="col-sm-2">
                                {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'请输入名称','id'=>'price']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('ispublic', '状态', array('class' => 'col-sm-1 control-label')) }}
                            <div class="col-sm-2">
                                {{ Form::select('ispublic', array('1'=>'发布','2'=>'不发布'), 2, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-4 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="icon-ok bigger-110"></i>
                                    确定
                                </button>
                                <a href="/annual/coursetype">
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