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
            <li class="active">课程库类型</li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                首页
                <small>
                    <i class="icon-double-angle-right fa fa-angle-double-right fa-lg"></i>
                    课程库类型
                </small>
            </h1>
        </div><!-- /.page-header -->
        <div class="row">
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
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>名称</th>
                                    <th class="center">课程数</th>
                                    <th class="center">是否公开</th>
                                    <th class="center">添加时间</th>
                                    <th class="center">操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($coursetypes as $t)
                                    <tr>
                                        <td class="center">{{$t->id}}</td>
                                        <td><a href="#">{{$t->name}}</a></td>
                                        <td class="center">{{$t->course_count}}</td>
                                        <td class="center">
                                            @if($t->ispublic==1)
                                                发布
                                            @else
                                                未发布
                                            @endif</td>
                                        <td class="center">{{$t->created}}</td>
                                        <td class="center">
                                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                @if($t->ispublic==1)
                                                    <a href="/annual/coursetype/{{$t->id}}/unpublic">
                                                        <button class="btn btn-xs btn-info">
                                                            <i class="icon-edit fa fa-minus fa-lg bigger-120"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="/annual/coursetype/{{$t->id}}/public">
                                                        <button class="btn btn-xs btn-info">
                                                            <i class="icon-edit fa fa-circle-o fa-lg bigger-120"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                                <a href="/annual/coursetype/{{$t->id}}/edit">
                                                    <button class="btn btn-xs btn-info">
                                                        <i class="icon-edit fa fa-edit fa-lg bigger-120"></i>
                                                    </button>
                                                </a>
                                                <a class="destroy" href="/annual/coursetype/{{$t->id}}/destroy">
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