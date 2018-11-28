@extends('app')

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default" style="margin-top: 0px">
                <!-- Tabs within a box -->
                <div class="box-header with-border">
                    <h3 class="box-title pull-left">
                        {{ trans('common.email'). ' ' .trans('common.settings') }}
                    </h3>
                    <a href="" onclick="new_smtp_credentials(event)" class="pull-right">{{ $title }}</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                        <tr class="active">
                            <th class="col-sm-1">#</th>
                            <th>{{ trans('common.mail_provider') }}</th>
                            <th>{{ trans('common.testing') }}</th>
                            <th>{{ trans('common.default') }}</th>
                            <th>{{ trans('common.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($smtpLists as $key =>$smtp)
                            <tr>
                                <td>
                                    <a href="#" onclick="show_stmp_credentials(event, '{{ $smtp->id }}')"
                                       data-toggle='tooltip' data-placement='top'
                                       title='{{ trans('common.mail_provider').' '.trans('common.detail') }}'>{!! $key+1 !!}
                                    </a>
                                </td>
                                <td>
                                    <a href="#" onclick="show_stmp_credentials(event, '{{ $smtp->id }}')"
                                       data-toggle='tooltip' data-placement='top'
                                       title='{{ trans('common.mail_provider').' '.trans('common.detail') }}'>
                                       {{ $smtp->mail_provider->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="label label-default" onclick="mail_testing_modal('{{ $smtp->id }}')"><span data-toggle='tooltip'
                                              data-placement='top'
                                              title='{{ trans('common.testing') }}'><i
                                                    class="fa fa-hand-o-up"></i></span></a>
                                </td>
                                <td>
                                    @if(isset($default_mail_provider) && ($smtp->id == $default_mail_provider))
                                        <span class="label label-success" data-toggle='tooltip'
                                              data-placement='top'
                                              title='{{ trans('common.active') }}'><i
                                                    class="fa fa-check"></i></span>
                                    @else
                                        <a href="{{ url('email_settings/default_change/'.$smtp->id) }}"
                                           data-toggle='tooltip' data-placement='top'
                                           title='{{ trans('common.inactive') }}' class="btn btn-xs btn-danger"><i
                                                    class="fa fa-close"></i></a>
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['email.destroy', $smtp->id], 'class' => 'delete-form']) !!}
                                    <a href="#" onclick="show_stmp_credentials(event, '{{ $smtp->id }}')" class='btn btn-info btn-xs'
                                       data-toggle='tooltip' data-placement='top'
                                       title='{{ trans('common.mail_provider').' '.trans('common.detail') }}'><i
                                                class='fa fa-list-alt'></i></a>
                                    <a href="" data-toggle='tooltip' data-placement='top'
                                       title='{{ trans('common.mail_provider').' '.trans('common.edit') }}' onclick="edit_stmp_credentials(event, '{{ $smtp->id }}')"
                                       class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                    {!! btn_delete_submit() !!}

                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="modal fade" id="smtp_provider_credentials" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="myModalLabel">{{ trans('common.mail_provider'). ' ' .trans('common.credentials') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1">
                                {!! Form::open(['url' => "email",'id'=>'mail_provider_form','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                                 @include('email_settings._form',['submit_button' => 'Submit'])

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mail_testing" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="myModalLabel">{{ trans('common.testing') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1">
                                {!! Form::open(['url' => "email-testing",'id'=>'mail_testing_form','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                                    <div class="form-group required">
                                        {!! Form::label('email_address',trans('common.email').' ' .trans('common.address') ,['class'=>' col-md-3 control-label']) !!}
                                        <div class="col-md-7">
                                            {!! Form::email('email_address',null, ['id' => 'email_address', "required", 'class' =>'form-control','placeholder' => 'your-name@your-domain.com']) !!}
                                            <p class="text-danger" id="email_address_error">{{$errors->first('email_address')}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group required" id="submit_btn_div">
                                        {!! Form::label(null,null,['class'=>' col-md-3 control-label']) !!}
                                        <div class="col-md-7">
                                            {!! Form::submit(trans('common.submit'),['class' => 'btn btn-primary pull-right', 'id' => 'submit_btn', 'onclick' => 'mail_testing(event)'])!!}
                                        </div>
                                    </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var email_settings_id;

            $(function () {
                $('.mail_driver_select').click(function (e) {
                    var select_driver = $(this).val();
                    if (select_driver == 'mail') {
                        $('#php_mail').show();
                    } else if (select_driver == 'smtp') {
                        $('#php_mail').hide();
                    }
                });
            });

            function mail_testing_modal(email_info_id) {
                email_settings_id = email_info_id;
                $('#mail_testing').modal('show');
            }

            function edit_stmp_credentials(e, id) {
                e.preventDefault();
                var update_id = id;
                var url = "{{ url('email') }}";

                $('.credential_div').hide();
                $('.text-danger').text('');

                $.ajax({
                    url: url + '/' + update_id + '/edit',
                    method: 'get',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $.each(data.email_settings, function (key, value) {
                            $('#' + key).val(value);
                        });

                        $.each(data.mail_provider, function (key, value) {
                            $('#' + value + '_div').show();
                        });

                        $('#update_id').val(update_id);
                        $('#submit_btn').val('{{ trans('common.update') }}');
                    },
                });

                $('#mail_provider').prop('disabled', false);
                $('#submit_btn_div').show();
                $('#smtp_provider_credentials').modal('show');
            }

            function show_stmp_credentials(e, id) {
                e.preventDefault();
                var update_id = id;
                var url = "{{ url('email') }}";

                $('.credential_div').hide();
                $('.text-danger').text('');

                $.ajax({
                    url: url + '/' + update_id + '/edit',
                    method: 'get',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $.each(data.email_settings, function (key, value) {
                            $('#' + key).val(value);
                        });

                        $.each(data.mail_provider, function (key, value) {
                            $('#' + value + '_div').show();
                        });

                        // $('#update_id').val(update_id);

                        // $('#submit_btn').val('{{ trans('common.update') }}');
                    },
                });

                $('#mail_provider').prop('disabled', 'disabled');
                $('#submit_btn_div').hide();
                $('#smtp_provider_credentials').modal('show');
            }

            function submit_form(e) {
                e.preventDefault();
                var formData = new FormData($('#mail_provider_form')[0]);
                var that = this;
                var url = "{{ url('email') }}";
                var update_id = $('#update_id').val();
                if (update_id > 0) {
                    url = url + '/' + update_id;
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if(data.error) {
                            swal({
                                    title: "Warning!",
                                    text: data.msg,
                                    type: "warning",
                                    confirmButtonText: "OK",
                                },
                                function (isConfirm) {
                                    // location.reload();
                                });

                        } else {

                            swal({
                                    title: "Saved!",
                                    text: data.msg,
                                    type: "success",
                                    confirmButtonText: "OK",
                                },
                                function (isConfirm) {
                                    location.reload();
                                });
                        }
                    },
                    error: function (errors) {
                        $.each(errors.responseJSON, function (key, error) {
                            $('#' + key + '_error').text(error[0]);
                        });
                    }
                });
            }

            function new_smtp_credentials(e) {
                e.preventDefault();
                $('.credential_div').hide();
                $('.text-danger').text('');
                $('#submit_btn').val('{{ trans('common.submit') }}');
                $('#mail_provider_form')[0].reset();
                $('#mail_provider').prop('disabled', false);
                $('#submit_btn_div').show();
                $('#smtp_provider_credentials').modal('show');
            }

            function mail_testing(e) {
                e.preventDefault();
                var formData = new FormData($('#mail_testing_form')[0]);
                var that = this;
                var url = "{{ url('email-testing') }}";
                
                if(email_settings_id) {
                    formData.append('email_settings_id', email_settings_id);
                }


                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if(data.error) {
                            swal({
                                    title: "Warning!",
                                    text: data.msg,
                                    type: "warning",
                                    confirmButtonText: "OK",
                                },
                                function (isConfirm) {
                                    location.reload();
                                });

                        } else {

                            swal({
                                    title: "Saved!",
                                    text: data.msg,
                                    type: "success",
                                    confirmButtonText: "OK",
                                },
                                function (isConfirm) {
                                    location.reload();
                                });
                        }
                    },
                    error: function (errors) {
                        $.each(errors.responseJSON, function (key, error) {
                            $('#' + key + '_error').text(error);
                        });
                    }
                });
            }

        </script>


@endsection