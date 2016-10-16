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
            <li class="active">基础课程库</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    基础课程库
                </small>
            </h1>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-sm-6">
                {{ Form::open(['url'=>'/annual/course','method'=>'get']) }}
                <div class="form-group">
                    <label class="control-label">关键字查询: {{ Form::text('keyword',$keyword) }}</label>
                    <label class="control-label">类型: {{ Form::select('search_type', $types, $search_type) }}</label>
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
                                    <col width="20%">
                                    <col width="10%">
                                    <col width="20%">
                                    <col width="15%">
                                    <col width="5%">
                                    <col width="5%">
                                    <col width="10%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>标题</th>
                                    <th>类型</th>
                                    <th>收益</th>
                                    <th>对象</th>
                                    <th class="center">价格</th>
                                    <th class="center">天数</th>
                                    <th class="center">添加时间</th>
                                    <th class="center">操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($courses as $c)
                                    <tr>
                                        <td class="center">{{$c->id}}</td>
                                        <td><a href="#">{{$c->title}}</a></td>
                                        <td class="center">{{$c->course_type_name}}</td>
                                        <td>{!!nl2br($c->info)!!}</td>
                                        <td>{!!nl2br($c->target)!!}</td>
                                        <td class="center">{{$c->price}}</td>
                                        <td class="center">{{$c->day}}</td>
                                        <td class="center">{{$c->created}}</td>
                                        <td class="center">
                                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                <a href="/annual/course/{{$c->id}}/edit">
                                                    <button class="btn btn-xs btn-info">
                                                        <i class="icon-edit fa fa-edit fa-lg bigger-120"></i>
                                                    </button>
                                                </a>
                                                <a class="destroy" href="/annual/course/{{$c->id}}/destroy">
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
                                <div class="dataTables_info">一共{{$courses->total()}}条记录,当前第{{$courses->currentPage()}}
                                    页
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate">{!! $courses->appends(['keyword' => $keyword,'search_type'=>$search_type])->links() !!}</div>
                            </div>
                        </div><!-- /.table-responsive -->
                    </div><!-- /span -->
                </div><!-- /row -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.page-content -->
    <script type="text/javascript">
        $(function(){
            $('.destroy').click(function(){
                return confirm('确认删除吗?');
            });
        })
    </script>
@endsection