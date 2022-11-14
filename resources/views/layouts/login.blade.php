<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/app.css') }}" />
    <script src="main.js"></script>
</head>

<body style="margin:100px">
    <div class="">
        <div class="pace-progress" style="transform: translate3d(100%, 0px, 0px);" data-progress-text="100%"
            data-progress="99">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>
    {{ Form::open(['url'=>route('authentication'),'method'=>'POST']) }}
    <div class="container">
        <div class="row justify-content-center">  
            <div class="col-md-4">
            @include('layouts.flash')
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-user"></i>
                                    </span>
                                </div>
                                {{ Form::text('user_name',null,['class'=>'form-control','placeholder'=>'User Name'])}}
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-lock"></i>
                                    </span>
                                </div>
                                {{ Form::password('password',['class'=>'form-control','placeholder'=>'Password'])}}
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary px-4" type="submit">Login</button>
                                </div>
                                <div class="col-6 text-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ form::close() }}

    <script src="vendors/jquery/js/jquery.min.js"></script>
    <script src="vendors/popper.js/js/popper.min.js"></script>
    <script src="vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendors/pace-progress/js/pace.min.js"></script>
    <script src="vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
    <script src="vendors/@coreui/coreui-pro/js/coreui.min.js"></script>
    <script>
        $('#ui-view').ajaxLoad();
        $(document).ajaxComplete(function () {
            Pace.restart()
        });
    </script>

</body>

</html>