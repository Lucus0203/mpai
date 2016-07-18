@extends('layouts.app')

@section('content')
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-i fa fa-home fa-lg"></i>
                <a href="/">首页</a>
            </li>
        </ul><!-- .breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                Home
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="alert alert-block alert-success">

                    <i class="icon-ok green"></i>

                    欢迎使用
                    <strong class="green">
                        培训派后台管理系统
                    </strong>
                </div>

                <div class="row">
                    <div class="space-6"></div>

                    <div class="infobox-container">
                        <div class="infobox infobox-green  ">
                            <div class="infobox-icon">
                                <i class="icon-user fa fa-user"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number">{{$todaycount}}</span>
                                <div class="infobox-content">今日注册企业</div>
                            </div>
                        </div>

                        <div class="infobox infobox-blue  ">
                            <div class="infobox-icon">
                                <i class="icon-users fa-users fa"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number">{{$weekcount}}</span>
                                <div class="infobox-content">本周注册企业</div>
                            </div>
                        </div>

                        <div class="infobox infobox-pink  ">
                            <div class="infobox-icon">
                                <i class="icon-building fa-building fa"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number">{{$monthcount}}</span>
                                <div class="infobox-content">本月注册企业</div>
                            </div>
                        </div>

                        <div class="infobox infobox-red  ">
                            <div class="infobox-icon">
                                <i class="icon-beaker fa-exclamation fa"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number">{{$failcount}}</span>
                                <a href="/company/failusers"><div class="infobox-content">未激活用户</div></a>
                            </div>
                        </div>
                    </div>
                </div><!-- /row -->

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
@endsection