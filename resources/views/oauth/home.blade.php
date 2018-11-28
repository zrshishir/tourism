@extends('app')


@section('main-content')
<div class="row" style="margin-top: 25px">
    
        <div class="col-md-1">           
        </div>


        <div class="col-md-9">

            <section class="box box-default">

                <div class="box-header with-border text-center">
                    <h3 class="box-title">Control Social Login / Sign up</h3>
                </div>

                <div class="box-body  text-center">
                    {!! Form::open(['url' => "config",'id'=>'config','class'=>'form-inline', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes']) !!}
                    <div class="form-group {{ $errors->has('enable_social_login') ? ' has-error' : '' }}">
                            
                            {!! Form::label('enable_social_login',trans('common.enable_social_login')) !!}
                                {!! Form::checkbox('enable_social_login', null, $enable_social_login ? true: false) !!}
                                <span class="text-danger help-block">
                                    {{$errors->first('enable_social_login')}}
                                </span>
                    </div>
                
                    <div class="form-group {{ $errors->has('enable_registration') ? ' has-error' : '' }}">
                            
                            {!! Form::label('enable_registration',trans('common.enable_registration')) !!}
                                {!! Form::checkbox('enable_registration', null, $enable_registration ? true : false) !!}                        
                                <span class="text-danger help-block">
                                    {{$errors->first('enable_registration')}}
                                </span>
                    </div>
                    {!! Form::submit('Change',['class' => 'btn btn-primary'])!!}
                    {!! Form::close() !!} 
                </div>
            </section>

        </div>

    </div>

    @if( \App\Models\Config\Config::where('key','enable_social_login')->first()->value == 1)
    <div class="row" style="margin-top: 25px" id="oauth">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked navbar-custom-nav">

                <li class="<?php echo (Request::get('platform') == 'facebook') || (Request::get('platform') == '')? 'active' : null; ?>">
                    <a href="{{ url('/oauth?platform=facebook') }}">
                        <i class="fa fa-facebook"></i>
                        {!! trans('common.facebook') !!}
                    </a>
                </li>

                <li class="<?php echo Request::get('platform') == 'google' ? 'active' : null; ?>">
                    <a href="{{ url('/oauth?platform=google') }}">
                        <i class="fa fa-google"></i>
                        {!! trans('common.google') !!}

                    </a>
                </li>

                <li class="<?php echo Request::get('platform') == 'twitter' ? 'active' : null; ?>">
                    <a href="{{ url('/oauth?platform=twitter') }}">
                        <i class="fa fa-twitter"></i>
                        {!! trans('common.twitter') !!}
                    </a>
                </li>

                <li class="<?php echo Request::get('platform') == 'linkedin' ? 'active' : null; ?>">
                    <a href="{{ url('/oauth?platform=linkedin') }}">
                        <i class="fa fa-linkedin"></i>
                        {!! trans('common.linkedin') !!}
                    </a>
                </li>

                <li class="<?php echo Request::get('platform') == 'github' ? 'active' : null; ?>">
                    <a href="{{ url('/oauth?platform=github') }}">
                        <i class="fa fa-github"></i>
                        {!! trans('common.github') !!}
                    </a>
                </li>

            </ul>
        </div>

        <div class="col-md-6">
            <section class="box box-default" style="margin-top: 0px">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$pageName}}</h3>
                </div>
                <div class="box-body">
                    {!! Form::open(['url' => "/oauth",'id'=>'oauth','class'=>'', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes']) !!}
                    @if(Request::get('platform'))
                        @include("oauth.". Request::get('platform') . "_form",['submit_button' => 'Submit'])
                    @else
                        @include("oauth.facebook_form",['submit_button' => 'Submit'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </section>
        </div>

    </div>
    @endif

@endsection