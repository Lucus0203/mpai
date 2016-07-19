@extends('layouts.app')

@section('content')
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active"><a href="/company/userlist">管理员用户</a></li>
            <li class="active">操作日志</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    <a href="/company/userlist">管理员用户</a>
                </small>
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    操作日志
                </small>
            </h1>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-sm-6">
                用户:{{$user->real_name}}
            </div>
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <colgroup>
                                <col width="100%">
                            </colgroup>
                            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                <colgroup
                                <thead>
                                <tr>
                                    <th>访问目录</th>
                                    <th>登录时间</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($logs as $o)
                                    <tr>
                                        <td>{{$o->url}}</td>
                                        <td>{{$o->created}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="col-sm-6">
                                <div class="dataTables_info">一共{{$logs->total()}}条记录,当前第{{$logs->currentPage()}}
                                    页
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate">{!! $logs->links() !!}</div>
                            </div>
                        </div><!-- /.table-responsive -->
                    </div><!-- /span -->
                </div><!-- /row -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.page-content -->
@endsection