@extends('layouts.app')

@section('content')
    <script>
        $(function () {
            $('.editNote').click(function(){
                var index=$('.editNote').index($(this));
                $('.noteSapn').eq(index).hide();
                $('input[name=note]').eq(index).attr('type','text');
                return false;
            });
            $('input[name=note]').blur(function(){
                var index=$('input[name=note]').index($(this));
                var cid=$('input[name=companyid]').eq(index).val();
                var note=$(this).val();
                $.ajax({
                    url:'/company/'+cid+'/updatenote',
                    type:'get',
                    data:{'note':note},
                    dataType:'json',
                    success:function(res){
                        if(res.success=='ok'){
                            $('input[name=note]').eq(index).attr('type','hidden');
                            $('.noteSapn').eq(index).text(note).show();
                        }
                    }
                });
            });
        });
    </script>
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
            <li class="active">已激活企业</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    已激活企业
                </small>
            </h1>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-sm-6">
                {{ Form::open(['url'=>'company/list','method'=>'get']) }}
                <label>关键字查询(公司/联系人/手机/邮箱): {{ Form::text('keyword',$keyword) }}</label>
                {{ Form::close()}}
                <a href="/company/export">导出企业名单</a>
            </div>
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                <colgroup>
                                    <col width="15%">
                                    <col width="10%">
                                    <col width="12%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="15%">
                                    <col width="10%">
                                    <col width="5%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>公司名称</th>
                                    <th>公司编号</th>
                                    <th>所属行业</th>
                                    <th class="center">联系人</th>
                                    <th class="center">手机</th>
                                    <th class="center">注册时间</th>
                                    <th class="center">备注</th>
                                    <th class="center">备注时间</th>
                                    <th class="center">操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($companys as $c)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="companyid" value="{!! $c->id !!}" />
                                            <a href="/company/{{$c->id}}/edit">{{$c->name}}</a>
                                        </td>
                                        <td>{{$c->code}}</td>
                                        <td>{{$c->parent_industry_name}} {{$c->industry_name}}</td>
                                        <td>{{$c->contact}}</td>
                                        <td>{{$c->mobile}}</td>
                                        <td class="center">{{$c->created}}</td>
                                        <td><input type="hidden" name="note" value="{!! $c->note !!}" /><span class="noteSapn">{!! $c->note !!}</span></td>
                                        <td class="center">{{date("m-d H:i",strtotime($c->updated))}}</td>
                                        <td class="center">
                                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                <a href="#" class="editNote">
                                                    <button class="btn btn-xs btn-info">
                                                        <i class="icon-edit fa fa-edit fa-lg bigger-120"></i>
                                                    </button>
                                                </a>
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
@endsection