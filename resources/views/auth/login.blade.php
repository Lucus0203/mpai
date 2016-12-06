<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- basic styles -->

    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}" />
    <!-- fonts -->

    <!-- ace styles -->

    <link rel="stylesheet" href="{{URL::asset('css/ace.min.css')}}" />
</head>

<body class="login-layout">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1> <i class="icon-leaf green"></i> <span class="red"></span> <span class="white">培训派</span> </h1>
                    </div>
                    <div class="space-6"></div>
                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger"> <i class="icon-coffee green"></i> 管理员登录 </h4>
                                    <div class="space-6"></div>
                                    {!! Form::open(['url'=>'/login']) !!}
                                    <fieldset>
                                        <label class="block clearfix"> <span class="block input-icon input-icon-right">
                                                    {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'用户名']) !!}
                                                <i class="icon-user"></i> </span> </label>
                                        <label class="block clearfix"> <span class="block input-icon input-icon-right">
                                                    {!! Form::password('password',['class'=>'form-control','placeholder'=>'密码']) !!}
                                                <i class="icon-lock"></i> </span> </label>
                                        <div class="space"></div>
                                        <div class="clearfix">
                                            <label class="inline">
                                                <input type="checkbox" style="display:none"/>
                                                <span class="lbl"> </span> </label>
                                            <button type="submit" class="width-35 pull-right btn btn-sm btn-primary"> <i class="icon-key"></i> 登陆 </button>
                                        </div>
                                        <div class="space-4"></div>
                                    </fieldset>
                                    {!! Form::close() !!}
                                    @if($errors->any())
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <!-- /widget-main -->
                            </div>
                            <!-- /widget-body -->
                        </div>
                        <!-- /login-box -->
                    </div>
                    <!-- /position-relative -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</div>
<!-- /.main-container -->

</body>
</html>