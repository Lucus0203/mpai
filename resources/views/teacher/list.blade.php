@extends('layouts.app')

@section('content')
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">讲师</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    讲师
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
                                <colgroup>
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>公司名称</th>
                                    <th>类型</th>
                                    <th class="center">头像</th>
                                    <th>头衔</th>
                                    <th>擅长类型</th>
                                    <th>年限</th>
                                    <th>时薪</th>
                                    <th class="center">操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($teachers as $t)
                                    <tr>
                                        <td>
                                            <a href="#">{{$t->name}}</a>
                                        </td>
                                        <td>{{$t->companyname}}</td>
                                        <td>{{$t->type}}</td>
                                        <td class="center">
                                            <img height="50"
                                                 src="{{$t->head_img?env('WEB_SITE').'uploads/teacher_img/'.$t->head_img:env('WEB_SITE').'images/face_default.png'}}" />
                                        </td>
                                        <td>{{$t->title}}</td>
                                        <td>{{$t->specialty}}</td>
                                        <td>{{$t->years}}</td>
                                        <td>{{$t->hourly}}</td>

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
                                <div class="dataTables_info">一共{{$teachers->total()}}条记录,当前第{{$teachers->currentPage()}}
                                    页
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate">{!! $teachers->appends(['keyword' => $keyword])->links() !!}</div>
                            </div>
                        </div><!-- /.table-responsive -->
                    </div><!-- /span -->
                </div><!-- /row -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.page-content -->
@endsection