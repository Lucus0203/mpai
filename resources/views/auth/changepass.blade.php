@extends('layouts.app')

@section('content')
    <div class="breadcrumbs" id="breadcrumbs">
        <script src="{{URL::asset('js/jquery.validate.min.js')}}"></script>
        <script type="text/javascript">
            jQuery(function($) {
                $('#form').validate({
                    errorElement: 'div',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules: {
                        oldpass: {
                            required: true
                        },
                        newpass: {
                            required: true,
                            minlength: 6
                        },
                        newpass_confirmation: {
                            required: true,
                            minlength: 6,
                            equalTo: "#newpass"
                        }
                    },

                    messages: {
                        oldpass: {
                            required: "请输入原密码"
                        },
                        newpass: {
                            required: "请输入新密码",
                            minlength: "新密码最少6位"
                        },
                        newpass_confirmation: {
                            required: "请再次输入新密码",
                            minlength: "最少6位",
                            equalTo: "两次密码不一致"
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

        <ul class="breadcrumb">
            <li>
                <i class="icon-i fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">修改密码</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    修改密码
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
                                <br />
                                @endforeach
                            </div>
                        @endif
                        @if(!empty($act))
                            @if($success===true)
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="icon-ok fa fa-remove"></i>
                                    </button>
                                        <strong>
                                            <i class="icon-remove fa fa-check"></i>
                                            {{$msg}}
                                        </strong>
                                        <br />
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="icon-remove fa fa-remove"></i>
                                    </button>
                                    <strong>
                                        <i class="icon-remove fa fa-remove"></i>
                                        {{$msg}}
                                    </strong>
                                    <br />
                                </div>
                            @endif
                        @endif
                        {{Form::open(['url'=>'auth/changepass','class'=>'form-horizontal','role'=>'form','id'=>'passform'])}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">原密码</label>
                            <div class="col-sm-9">
                                {{Form::password('oldpass',['placeholder'=>'请输入原密码','class'=>'col-xs-12 col-sm-4'])}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">新密码</label>
                            <div class="col-sm-9">
                                {{Form::password('newpass',['placeholder'=>'请输入新密码','class'=>'col-xs-12 col-sm-4','id'=>'newpass'])}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">确认密码</label>
                            <div class="col-sm-9">
                                {{Form::password('newpass_confirmation',['placeholder'=>'请再次输入新密码','class'=>'col-xs-12 col-sm-4'])}}
                            </div>
                        </div>

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="icon-ok bigger-110"></i>
                                    确认修改
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="icon-undo bigger-110"></i>
                                    重置
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