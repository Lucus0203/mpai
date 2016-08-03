@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $(function(){
            $('.destroyBtn').click(function(){
                return confirm('确定删除吗?');
            });
        });
    </script>
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">岗位列表</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    岗位列表
                </small>
            </h1>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-sm-6">
                {{ Form::open(['url'=>'/ability/job','method'=>'get']) }}
                <div class="form-group">
                    <label class="control-label">关键字查询: {{ Form::text('keyword',$keyword) }}</label>
                    <label class="control-label">类型: {{ Form::select('search_type', array(''=>'全部','1'=>'通用岗位','2'=>'定制岗位'), $search_type) }}</label>
                    <button class="btn btn-info" type="submit" style="width: 50px;height: 30px;padding:0;">
                        <i class="icon-ok"></i>
                        确定
                    </button>
                </div>
                {{ Form::close()}}
            </div>
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
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
                            操作成功
                        </strong>
                        <br />
                    </div>
                @endif
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                <colgroup>
                                    <col width="5%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="5%">
                                    <col width="10%">
                                    <col width="5%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th class="center">编号</th>
                                    <th>类型</th>
                                    <th>名称</th>
                                    <th class="center">状态</th>
                                    <th class="center">添加时间</th>
                                    <th class="center">操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($jobs as $job)
                                    <tr>
                                        <td class="center">
                                            <a href="/ability/job/{{$job->id}}/edit">{{$job->id}}</a>
                                        </td>
                                        <td>
                                            @if($job->type == 1)
                                                通用模型
                                            @elseif($job->type == 2)
                                                定制模型
                                            @endif
                                        </td>
                                        <td>{{$job->name}}</td>
                                        <td class="center">
                                            @if($job->status==1)
                                                发布
                                            @else
                                                未发布
                                            @endif
                                        </td>
                                        <td class="center">{{$job->created}}</td>
                                        <td class="center">
                                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                @if($job->status==1)
                                                    <a href="/ability/job/{{$job->id}}/unpublish">
                                                        <button class="btn btn-xs btn-info">
                                                            <i class="icon-edit fa fa-undo fa-lg bigger-120"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="/ability/job/{{$job->id}}/publish">
                                                        <button class="btn btn-xs btn-info">
                                                            <i class="icon-edit fa fa-check-circle fa-lg bigger-120"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                                <a href="/ability/job/{{$job->id}}/edit">
                                                    <button class="btn btn-xs btn-info">
                                                        <i class="icon-edit fa fa-edit fa-lg bigger-120"></i>
                                                    </button>
                                                </a>
                                                <a class="destroyBtn" href="/ability/job/{{$job->id}}/destroy">
                                                    <button class="btn btn-xs btn-info">
                                                        <i class="icon-edit fa fa-trash-o fa-lg bigger-120"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="col-sm-6">
                                <div class="dataTables_info">一共{{$jobs->total()}}条记录,当前第{{$jobs->currentPage()}}
                                    页
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate">{!! $jobs->appends(['keyword' => $keyword,'search_type'=>$search_type])->links() !!}</div>
                            </div>
                        </div><!-- /.table-responsive -->
                    </div><!-- /span -->
                </div><!-- /row -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.page-content -->
@endsection