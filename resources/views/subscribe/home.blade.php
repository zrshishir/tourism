@extends('auth.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')

    <body class="login-page">
    <div class="login-logo" style="margin-top: 60px">
        <a href="{{ url('/home') }}">{!! configValue('site_name') !!}</a>
    </div>
    <div class="login-box">

        <!-- /.login-logo -->

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> {!! trans('auth.input_error') !!}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    @if(Session::has('login_error_msg'))
                        <li>{{ Session::get('login_error_msg') }}</li>
                    @endif
                </ul>
            </div>
        @elseif(Session::has('subscribe_error_msg'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ Session::get('subscribe_error_msg') }}</li>
                </ul>
            </div>
        @elseif(Session::has('subscribe_success_msg'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ Session::get('subscribe_success_msg') }}</li>
                </ul>
            </div>
        @endif

        <div class="login-box-body">
            <div class="text-center">
                <div class="icon-object border-slate-300 text-slate-300" style="margin: 0px;"><i
                            class="fa fa-user-secret" style="font-size:22px"></i></div>
                <h5 class="content-group">{!! trans('common.subscribe') !!}</h5>
            </div>

            <form action="{{ url('/subscribe') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="api_key" value="{{ $api_key }}">
                <input type="hidden" name="group_id" value="{{ $group_id }}">

                <div class="form-group has-feedback">
                    <input type="name" class="form-control" placeholder="{!! trans('common.name') !!}" name="name"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="{!! trans('common.email') !!}" name="email"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-login btn-block">{!! trans('common.submit') !!} <i
                                class="fa fa-arrow-right "></i></button>
                </div>
            </form>

            <!-- /.social-auth-links -->
        </div>
        <!-- /.login-box-body -->

    </div>
    <!-- /.login-box -->

    @include('auth.scripts')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
        if (top != self) {
            window.open(self.location.href, '_top');
        }
    </script>
    </body>

@endsection
