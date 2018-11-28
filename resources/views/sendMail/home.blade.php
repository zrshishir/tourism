@extends('app')

@section('main-content')
    <div class="ajax-overlay"><p><i class="fa fa-spin fa-refresh fa-5x"></i></p></div>
    @if(Session::has('block_errors'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('block_errors') }}
        </div>
    @endif
    @if(isset($email_settings_info))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <a href="{{ url('email') }}" style="text-decoration: none; color: #a94442">{{ $email_settings_info }}</a>
        </div>
    @endif
    <div style="margin-top: 0px;" class="box box-default">
        <!-- Tabs within a box -->
        <div class="box-header with-border">
            <h3 class="box-title pull-left">
                {!! trans('common.send').' '.trans('common.email')  !!}
            </h3>
        </div>

        <div class="box-body">
            {!! Form::open(['url' => "send-mail",'id'=>'send-mail','class'=>'form-horizontal send-email-form', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                @include('sendMail.single_form',['submit_button' => 'Send e-mail'])

            {!! Form::close() !!}
        </div>

    </div>

    @foreach($template_lists as $list)
        <div class="modal fade" id="template_detail_{{ $list->id }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="myModalLabel">{{ $list->name . ' ' . trans('common.template') }}</h4>
                    </div>
                    <div class="modal-body">
                        {!! $list->template !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function show_template() {
            var template_id = $('#select_template_single').val();
            $('#template_detail_' + template_id).modal('show');
        }


        $(function(){
            $('#timezone').val(-new Date().getTimezoneOffset()/60);
        });

        $('.send-email-form').submit(function (e) {
            //            e.preventDefault();
            $('.ajax-overlay').show();
            return true;
        });


        $('#schedule').click(function (e) {
            e.preventDefault();
            if ($('#datetime_div').is(':hidden')) {
                $('#datetime_div').slideDown('slow');
            } else {
                $('#datetime_div').slideUp('slow');
            }
        });

        $('.schedule_group').click(function (e) {
            e.preventDefault();
            if ($('#datetime_group_div').is(':hidden')) {
                $('#datetime_group_div').slideDown('slow');
                $('#remove_schedule_group').slideDown('slow');
                $('#div_schedule_group').slideUp('slow');
                $('#send_later_identifier_group').val(1);
            } else {
                $('#div_schedule_group').slideDown('slow');
                $('#datetime_group_div').slideUp('slow');
                $('#remove_schedule_group').slideUp('slow');
                $('#send_later_identifier_group').val(0);
            }
        });

        $('.schedule_email').click(function (e) {
            e.preventDefault();
//            alert(-new Date().getTimezoneOffset());
            if ($('#datetime_email_div').is(':hidden')) {
                $('#datetime_email_div').slideDown('slow');
                $('#remove_schedule_email').slideDown('slow');
                $('#div_schedule_email').slideUp('slow');
                $('#send_later_identifier_email').val(1);
            } else {
                $('#div_schedule_email').slideDown('slow');
                $('#datetime_email_div').slideUp('slow');
                $('#remove_schedule_email').slideUp('slow');
                $('#send_later_identifier_email').val(0);
            }
        });
    </script>

@endsection