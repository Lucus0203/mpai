@extends('layouts.app')

@section('content')
    <script>
        $(function(){
            $('.destroy').click(function(){
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
            <li class="active">企业功能列表</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    企业功能列表
                </small>
            </h1>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-sm-6">
                {{ Form::open(['url'=>'order','method'=>'get']) }}
                <label>关键字查询(公司/公司编号/联系人): {{ Form::text('keyword',$keyword) }}</label>
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
                                    <col width="15%">
                                    <col width="12%">
                                    <col width="10%">
                                    <col width="5%">
                                    <col width="5%">
                                    <col width="5%">
                                    <col width="5%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="5%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>公司名称</th>
                                    <th>功能模块</th>
                                    <th>功能内容</th>
                                    <th>年限</th>
                                    <th>总次数</th>
                                    <th>剩余数</th>
                                    <th>费用</th>
                                    <th>付费时间</th>
                                    <th>开始时间</th>
                                    <th>审核</th>
                                    <th class="center">操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($orders as $c)
                                    <tr>
                                        <td>
                                            <a href="#">{{$c->company_name}}</a>
                                        </td>
                                        <td>@if($c->module=='ability')
                                                能力模型
                                            @elseif($c->module=='annualplan')
                                                年度计划
                                            @endif</td>
                                        <td>{{$c->features_name}}</td>
                                        <td>@if($c->years==0)
                                                永久
                                                @else
                                                {{$c->years}}年
                                            @endif</td>
                                        <td>@if($c->use_num==0)
                                                无限
                                            @else
                                                {{$c->use_num}}
                                            @endif</td>
                                        <td>@if($c->use_num==0)
                                                无限
                                            @else
                                                {{$c->use_num_remain}}
                                            @endif</td>
                                        <td>{{$c->cost}}</td>
                                        <td>@if($c->paid_status==1)
                                                未付
                                            @else
                                                {{$c->paid_time}}
                                            @endif</td>
                                        <td>{{$c->start_time}}</td>
                                        <td class="center">@if($c->checked==1)
                                                通过
                                            @else
                                                待审核
                                            @endif</td>
                                        <td class="center">
                                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                <a href="/order/{{$c->id}}/edit">
                                                    <button class="btn btn-xs btn-info">
                                                        <i class="icon-edit fa fa-edit fa-lg bigger-120"></i>
                                                    </button>
                                                </a>
                                                @if($c->checked==1)
                                                    <a href="/order/{{$c->id}}/unchecked">
                                                    <button class="btn btn-xs btn-info">
                                                        <i class="icon-edit fa fa-times-circle fa-lg bigger-120"></i>
                                                    </button></a>
                                                @else
                                                    <a href="/order/{{$c->id}}/checked">
                                                    <button class="btn btn-xs btn-info">
                                                        <i class="icon-edit fa fa-check-circle fa-lg bigger-120"></i>
                                                    </button></a>
                                                @endif
                                                <a class="destroy" href="/order/{{$c->id}}/destroy">
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
                                <div class="dataTables_info">一共{{$orders->total()}}条记录,当前第{{$orders->currentPage()}}
                                    页
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate">{!! $orders->appends(['keyword' => $keyword])->links() !!}</div>
                            </div>
                        </div><!-- /.table-responsive -->
                    </div><!-- /span -->
                </div><!-- /row -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.page-content -->
@endsection