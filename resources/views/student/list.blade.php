@extends('layouts.app')

@section('content')
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">学员</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    学员
                </small>
            </h1>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-sm-6">
                {{ Form::open(['url'=>'student','method'=>'get']) }}
                <label>关键字查询: {{ Form::text('keyword',$keyword) }}</label>
                {{ Form::close()}}
            </div>
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                <colgroup>
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="5%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="5%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>公司名称</th>
                                    <th>用户名</th>
                                    <th class="center">性别</th>
                                    <th>部门</th>
                                    <th>职位</th>
                                    <th>邮箱</th>
                                    <th>电话</th>
                                    <th>角色</th>
                                    <th class="center">操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($students as $s)
                                    <tr>
                                        <td>
                                            <a href="#">{{$s->name}}</a>
                                        </td>
                                        <td>{{$s->companyname}}</td>
                                        <td>{{$s->user_name}}</td>
                                        <td class="center">
                                            {{$s->sex == 1?'男':'女'}}
                                        </td>
                                        <td>{{$s->parent_departmentname}} {{$s->departmentname}}</td>
                                        <td>{{$s->job_name}}</td>
                                        <td>{{$s->email}}</td>
                                        <td>{{$s->mobile}}</td>
                                        <td>
                                            @if($s->role==1)
                                                普通学员
                                            @elseif($s->role==2)
                                                助理管理员
                                            @else
                                                员工经理
                                            @endif
                                        </td>

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
                                <div class="dataTables_info">一共{{$students->total()}}条记录,当前第{{$students->currentPage()}}
                                    页
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate">{!! $students->appends(['keyword' => $keyword])->links() !!}</div>
                            </div>
                        </div><!-- /.table-responsive -->
                    </div><!-- /span -->
                </div><!-- /row -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
@endsection