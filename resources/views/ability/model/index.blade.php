@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $(function(){$('#destroy').click(function(){return confirm('确定删除吗?')});});
    </script>
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">能力列表</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    能力列表
                </small>
            </h1>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-sm-6">
                {{ Form::open(['url'=>'/ability/model','method'=>'get']) }}
                <div class="form-group">
                    <label class="control-label">关键字查询: {{ Form::text('keyword',$keyword) }}</label>
                    <label class="control-label">类型: {{ Form::select('search_type', array(''=>'全部','1'=>'专业能力','2'=>'通用能力','3'=>'领导力','4'=>'个性','5'=>'经验'), $search_type) }}</label>
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
                                    <col width="30%">
                                    <col width="5%">
                                    <col width="10%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>类型</th>
                                    <th>名称</th>
                                    <th>能力描述</th>
                                    <th class="center">评级数</th>
                                    <th class="center">添加时间</th>
                                    <th class="center">操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($models as $m)
                                    <tr>
                                        <td>
                                            <a href="/ability/model/{{$m->id}}/edit">{{$m->code}}</a>
                                        </td>
                                        <td>
                                            @if($m->type == 1)
                                            专业能力
                                            @elseif($m->type == 2)
                                            通用能力
                                            @elseif($m->type == 3)
                                            领导力
                                            @elseif($m->type == 4)
                                            个性
                                            @else
                                            经验
                                            @endif
                                        </td>
                                        <td>{{$m->name}}</td>
                                        <td>{{$m->info}}</td>
                                        <td class="center">{{$m->level}}</td>
                                        <td class="center">{{$m->created}}</td>
                                        <td class="center">
                                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                <a href="/ability/model/{{$m->id}}/edit">
                                                    <button class="btn btn-xs btn-info">
                                                    <i class="icon-edit fa fa-edit fa-lg bigger-120"></i>
                                                    </button>
                                                </a>
                                                <a id="destroy" href="/ability/model/{{$m->id}}/destroy">
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
                                <div class="dataTables_info">一共{{$models->total()}}条记录,当前第{{$models->currentPage()}}
                                    页
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate">{!! $models->appends(['keyword' => $keyword,'search_type'=>$search_type])->links() !!}</div>
                            </div>
                        </div><!-- /.table-responsive -->
                    </div><!-- /span -->
                </div><!-- /row -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.page-content -->
@endsection