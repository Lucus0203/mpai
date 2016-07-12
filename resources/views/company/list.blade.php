@extends('layouts.app')

@section('content')
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">公司</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    公司
                </small>
            </h1>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-sm-6">
                {{ Form::open(['url'=>'company','method'=>'get']) }}
                <label>关键字查询(公司/联系人/手机/邮箱): {{ Form::text('keyword',$keyword) }}</label>
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
                                    <th>公司名称</th>
                                    <th>公司编号</th>
                                    <th>所属行业</th>
                                    <th class="center">logo</th>
                                    <th>联系人</th>
                                    <th>手机</th>
                                    <th>邮箱</th>
                                    <th class="center">操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($companys as $c)
                                    <tr>
                                        <td>
                                            <a href="#">{{$c->name}}</a>
                                        </td>
                                        <td>{{$c->code}}</td>
                                        <td>{{$c->parent_industry_name}} {{$c->industry_name}}</td>
                                        <td class="center"><img height="50"
                                                                src="{{env('WEB_SITE')}}uploads/company_logo/{{$c->logo}}" />
                                        </td>
                                        <td>{{$c->contact}}</td>
                                        <td>{{$c->mobile}}</td>
                                        <td>{{$c->email}}</td>

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
                                <div class="dataTables_info">一共{{$companys->total()}}条记录,当前第{{$companys->currentPage()}}
                                    页
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate">{!! $companys->appends(['keyword' => $keyword])->links() !!}</div>
                            </div>
                        </div><!-- /.table-responsive -->
                    </div><!-- /span -->
                </div><!-- /row -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.page-content -->
    <!-- page specific plugin scripts -->
    <script type="text/javascript">
        jQuery(function ($) {

            $('table th input:checkbox').on('click', function () {
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox')
                        .each(function () {
                            this.checked = that.checked;
                            $(this).closest('tr').toggleClass('selected');
                        });

            });

        })
    </script>
@endsection