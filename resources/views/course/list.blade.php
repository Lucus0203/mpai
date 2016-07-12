@extends('layouts.app')

@section('content')
    <div class="breadcrumbs" id="breadcrumbs">

        <ul class="breadcrumb">
            <li>
                <i class="icon-home fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">课程</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    课程
                </small>
            </h1>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-sm-6">
                {{ Form::open(['url'=>'course','method'=>'get']) }}
                <label>关键字查询: {{ Form::text('keyword',$keyword) }}</label>
                {{ Form::close()}}
            </div>
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>课程名称</th>
                                    <th>公司名称</th>
                                    <th>开课地点</th>
                                    <th class="center">开课时间</th>
                                    <th>讲师</th>
                                    <th>价格</th>
                                    <th>报名人数</th>
                                    <th class="center">操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($courses as $c)
                                    <tr>
                                        <td>
                                            <a href="#">{{$c->title}}</a>
                                        </td>
                                        <td>{{$c->companyname}}</td>
                                        <td>{{$c->address}}</td>
                                        <td class="center">
                                            {{$c->time_start}}
                                        </td>
                                        <td>{{$c->teachername}}</td>
                                        <td>{{$c->price}}</td>
                                        <td>{{$c->apply_count}}</td>

                                        <td class="center">
                                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                <button class="btn btn-xs btn-info">
                                                    <i class="icon-edit fa fa-edit fa-lg bigger-120"></i>
                                                </button>
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
                                <div class="dataTables_paginate">{!! $courses->appends(['keyword' => $keyword])->links() !!}</div>
                            </div>
                        </div><!-- /.table-responsive -->
                    </div><!-- /span -->
                </div><!-- /row -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
@endsection