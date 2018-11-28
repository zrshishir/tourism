@extends('app')

@section('main-content')
    <style type="text/css">
        .panel-template-style:hover {
            border-color: #166dba;
        }

        .panel-template-style .panel-body img {
            max-width: 100%;
        }
    </style>
    <!-- /set active menu -->
    <div class="row">
        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-2">
            <a href="{!! url('build/1_column') !!}">
                <div class="panel panel-flat panel-template-style">
                    <div class="panel-body">
                        <img src="http://demo.acellemail.com/images/template_styles/1_column.png">
                        <h5 class="mb-0 text-center">1 {!! trans('column') !!}</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-2">
            <a href="{!! url('build/1_2_column') !!}">
                <div class="panel panel-flat panel-template-style">
                    <div class="panel-body">
                        <img src="http://demo.acellemail.com/images/template_styles/1_2_column.png">
                        <h5 class="mb-0 text-center">1:2 {!! trans('column') !!}</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-2">
            <a href="{!! url('build/1_2_1_column') !!}">
                <div class="panel panel-flat panel-template-style">
                    <div class="panel-body">
                        <img src="http://demo.acellemail.com/images/template_styles/1_2_1_column.png">
                        <h5 class="mb-0 text-center">1:2:1 {!! trans('column') !!}</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-2">
            <a href="{!! url('build/1_3_column') !!}">
                <div class="panel panel-flat panel-template-style">
                    <div class="panel-body">
                        <img src="http://demo.acellemail.com/images/template_styles/1_3_column.png">
                        <h5 class="mb-0 text-center">1:3 {!! trans('column') !!}</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-2">
            <a href="{!! url('build/1_3_1_column') !!}">
                <div class="panel panel-flat panel-template-style">
                    <div class="panel-body">
                        <img src="http://demo.acellemail.com/images/template_styles/1_3_1_column.png">
                        <h5 class="mb-0 text-center">1:3:1 {!! trans('column') !!}</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-2">
            <a href="{!! url('build/1_3_2_column') !!}">
                <div class="panel panel-flat panel-template-style">
                    <div class="panel-body">
                        <img src="http://demo.acellemail.com/images/template_styles/1_3_2_column.png">
                        <h5 class="mb-0 text-center">1:3:2 {!! trans('column') !!}</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-2">
            <a href="{!! url('build/2_column') !!}">
                <div class="panel panel-flat panel-template-style">
                    <div class="panel-body">
                        <img src="http://demo.acellemail.com/images/template_styles/2_column.png">
                        <h5 class="mb-0 text-center">2 {!! trans('column') !!}</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-2">
            <a href="{!! url('build/2_1_column') !!}">
                <div class="panel panel-flat panel-template-style">
                    <div class="panel-body">
                        <img src="http://demo.acellemail.com/images/template_styles/2_1_column.png">
                        <h5 class="mb-0 text-center">2:1 {!! trans('column') !!}</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-2">
            <a href="{!! url('build/2_1_2_column') !!}">
                <div class="panel panel-flat panel-template-style">
                    <div class="panel-body">
                        <img src="http://demo.acellemail.com/images/template_styles/2_1_2_column.png">
                        <h5 class="mb-0 text-center">2:1:2 {!! trans('column') !!}</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-2">
            <a href="{!! url('build/3_1_3_column') !!}">
                <div class="panel panel-flat panel-template-style">
                    <div class="panel-body">
                        <img src="http://demo.acellemail.com/images/template_styles/3_1_3_column.png">
                        <h5 class="mb-0 text-center">3:1:3 {!! trans('column') !!}</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
