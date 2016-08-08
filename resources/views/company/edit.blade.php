@extends('layouts.app')

@section('content')
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-i fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">企业备注</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    企业备注
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
                        {{Form::open(['method'=>'put','url'=>'/company/'.$company->id.'/store','class'=>'form-horizontal','role'=>'form','id'=>'companyform'])}}
                            <div class="form-group">
                                {{ Form::label('code', '企业编号', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-2">
                                    {{$company->code}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('name', '企业名称', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-2">
                                    {{$company->name}}
                                </div>
                            </div>
                            @if(!empty($company->logo))
                            <div class="form-group">
                                {{ Form::label('logo', '企业LOGO', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-2">
                                    <img src="{{env('WEB_SITE')}}uploads/company_logo/{{$company->logo}}" width="100" />
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                {{ Form::label('real_name', '联系人', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-2">
                                    {{$user->real_name}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('mobile', '手机', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-2">
                                    {{$user->mobile}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('email', '邮箱', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-2">
                                    {{$user->email}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('user_name', '账号', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-2">
                                    {{$user->user_name}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('note', '企业备注', array('class' => 'col-sm-1 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::textarea('note',$company->note,['class'=>'autosize-transition form-control','id'=>'info','size' => '30x5']) }}
                                </div>
                            </div>
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-4 col-md-9">
                                    <button class="btn btn-info" type="submit">
                                        <i class="icon-ok bigger-110"></i>
                                        确定
                                    </button>
                                    <a href="/company/list">
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