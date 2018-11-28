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
        @elseif(Session::has('login_error_msg'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ Session::get('login_error_msg') }}</li>
                </ul>
            </div>
        @endif

        <div class="login-box-body">
            <div class="text-center">
                <div class="icon-object border-slate-300 text-slate-300" style="margin: 0px;"><i
                            class="fa fa-user-secret" style="font-size:22px"></i></div>
                <h5 class="content-group">{!! trans('auth.login_message') !!}
                    <small class="display-block">{!! trans('auth.credentials') !!}</small>
                </h5>
            </div>

            <form action="{{ url('/login') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="{!! trans('common.email') !!}" name="email"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="{!! trans('common.password') !!}"
                           name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row" style="margin-top: 20px;margin-bottom: 20px">
                    <div class="col-xs-6">
                        <input type="checkbox" name="remember"> {!! trans('auth.remember') !!}
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6 text-right">
                        <a href="{{ url('/password/reset') }}">{!! trans('auth.Forgot password') !!}</a>
                    </div>
                    <!-- /.col -->
                </div>
              
                <div class="form-group">
                    <button type="submit" class="btn btn-login btn-block">{!! trans('auth.log_in') !!} <i
                                class="fa fa-arrow-right "></i></button>
                </div>
            </form>

            @if( \App\Models\Config\Config::where('key','enable_registration')->first()->value == 1)

                <div class="content-divider text-muted form-group "><span>{!! trans('auth.dont_have_account') !!}</span>
            </div>
                <a href="{{ url('/register') }}" style="padding: 6px"
               class="btn btn-default btn-block content-group">{!! trans('auth.Sign up') !!}</a>
            @endif
            <span class="help-block text-center no-margin">{!! trans('auth.term_condition') !!} <a target="_blank"
                                                                                                   href="{{ url('termsCondition') }}">{!! trans('auth.terms') !!}
                    &amp; {!! trans('auth.Conditions') !!}</a> {!! trans('common.and') !!} <a target="_blank"
                                                                                              href="{!! url('privacyPolicy') !!}">{!! trans('common.privacy_policy') !!}</a></span>

            {{--<a href="{{ url('/password/email') }}">I forgot my password</a><br>--}}
            {{--<a href="{{ url('/auth/register') }}" class="text-center">Register a new membership</a>--}}
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
