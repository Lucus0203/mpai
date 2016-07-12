<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>培训派-后台管理系统</title>
    <meta name="keywords" content="培训派" />
    <meta name="description" content="培训派" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- basic styles -->
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}" />
    <!-- ace styles -->
    <link rel="stylesheet" href="{{URL::asset('css/ace.min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/ace-rtl.min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/ace-skins.min.css')}}" />

    <script src="{{URL::asset('js/ace-extra.min.js')}}"></script>
    <!-- basic scripts -->

    <!--[if !IE]> -->

    <script src="{{URL::asset('js\jquery-2.0.3.min.js')}}"></script>

    <!-- <![endif]-->

    <!--[if IE]>
    <script src="{{URL::asset('js\jquery-1.10.2.min.js')}}"></script>
    <![endif]-->
    <script type="text/javascript">
        if("ontouchend" in document) document.write("<script src='{{URL::asset('js/jquery.mobile.custom.min.js')}}'>"+"<"+"script>");
    </script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('js/typeahead-bs2.min.js')}}"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
    <script src="{{URL::asset('js/excanvas.min.js')}}"></script>
    <![endif]-->

    <script src="{{URL::asset('js/jquery-ui-1.10.3.custom.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery.ui.touch-punch.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery.easy-pie-chart.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery.sparkline.min.js')}}"></script>
    <script src="{{URL::asset('js/flot/jquery.flot.min.js')}}"></script>
    <script src="{{URL::asset('js/flot/jquery.flot.pie.min.js')}}"></script>
    <script src="{{URL::asset('js/flot/jquery.flot.resize.min.js')}}"></script>

    <!-- ace scripts -->

    <script src="{{URL::asset('js/ace-elements.min.js')}}"></script>
    <script src="{{URL::asset('js/ace.min.js')}}"></script>
</head>

<body>
<div class="navbar navbar-default" id="navbar">

    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    培训派
                </small>
            </a><!-- /.brand -->
        </div><!-- /.navbar-header -->

        <div class="navbar-header pull-right" role="navigation">

            <ul class="nav ace-nav">

                <li class="purple">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-i fa fa-bell fa-lg"></i>
                        <span class="badge badge-important">8</span>
                    </a>
                </li>

                <li class="green">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-i fa fa-envelope fa-lg"></i>
                        <span class="badge badge-success">5</span>
                    </a>
                </li>

                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="avatars/user.png" alt="Jason's Photo" />
								<span class="user-info">
									<small>欢迎光临,</small>
									Admin
								</span>

                        <i class="icon-i fa fa-caret-down fa-lg"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

                        <li>
                            <a href="/logout">
                                <i class="icon-i fa fa-power-off fa-lg"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- /.ace-nav -->
        </div><!-- /.navbar-header -->
    </div><!-- /.container -->
</div>

<div class="main-container" id="main-container">

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>

        <div class="sidebar" id="sidebar">

            <ul class="nav nav-list">
                <li class="{{ Request::segment(1)=='' ? 'active' : '' }}">
                    <a href="/">
                        <i class="icon-i fa fa-home fa-lg" aria-hidden="true"></i>
                        <span class="menu-text"> 首页 </span>
                    </a>
                </li>

                <li class="{{ Request::segment(1)=='company' ? 'active' : '' }}">
                    <a href="/company">
                        <i class="icon-i fa fa-building fa-lg" aria-hidden="true"></i>
                        <span class="menu-text"> 公司 </span>
                    </a>
                </li>

                <li class="{{ Request::segment(1)=='course' ? 'active' : '' }}">
                    <a href="/course">
                        <i class="icon-i fa fa-coffee fa-lg" aria-hidden="true"></i>
                        <span class="menu-text"> 课程 </span>
                    </a>
                </li>

                <li class="{{ Request::segment(1)=='student' ? 'active' : '' }}">
                    <a href="/student">
                        <i class="icon-i fa fa-group fa-lg" aria-hidden="true"></i>
                        <span class="menu-text"> 学员 </span>
                    </a>
                </li>

                <li class="{{ Request::segment(1)=='teacher' ? 'active' : '' }}">
                    <a href="/teacher">
                        <i class="icon-i fa fa-graduation-cap fa-lg" aria-hidden="true"></i>
                        <span class="menu-text"> 讲师 </span>
                    </a>
                </li>

            </ul><!-- /icon -->

            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="icon-double-angle-left fa fa-angle-double-left fa-lg" aria-hidden="true" data-icon1="fa-angle-double-left" data-icon2="fa-angle-double-right"></i>
            </div>
        </div>

        <div class="main-content">
            @yield('content')
        </div><!-- /.main-content -->

    </div><!-- /.main-container-inner -->

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="icon-double-angle-up fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->


</body>
</html>