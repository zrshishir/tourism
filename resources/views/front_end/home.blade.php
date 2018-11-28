@extends('app')

@section('main-content')

    <div class="box box-default" style="margin-top: 0px">
        <!-- Tabs within a box -->
        <div class="box-header with-border">
            <h3 class="box-title pull-left">
                {{ $pageName }}
            </h3>
            <a href="" onclick="new_frontend(event)"
               class="pull-right">{{ trans('common.new').' '.$pageName}}</a>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                    <tr class="active">
                        <th class="col-sm-1">#</th>
                        <th>{{ trans('common.menu') }}</th>
                        <th>{{ trans('common.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($frontEnds as $key =>$frontEnd)
                    <tr>
                        <td>{!! $key+1 !!}</td>
                        <td>{{ $frontEnd->menu }}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['frontend.destroy', $frontEnd->id], 'class' => 'delete-form']) !!}
                            <a href="" onclick="edit_frontend(event, '{{ $frontEnd->id }}')"
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

    <div class="modal fade" id="frontend_modal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="myModalLabel">{{ $pageName }}</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => "frontend",'id'=>'frontend_from','class'=>'', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                    @include('front_end._form',['submit_button' => 'Submit'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script>

        function edit_frontend(e, id) {
            e.preventDefault();
            var update_id = id;
            var url = "{{ url('frontend') }}";
            $.ajax({
                url: url + '/' + update_id + '/edit',
                method: 'get',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.error){
                        swal({
                                title: "Warning!",
                                text: response.msg,
                                type: "warning",
                                confirmButtonText: "OK",
                            },
                            function (isConfirm) {
                                location.reload();
                            });
                    } else {
                        $.each(response.data, function (key, value) {
                            if(key == 'description'){
                                $('#description').code(value);
                            }else{
                                $('#' + key).val(value);
                            }
                        });
                    }
                },
            });

            $('#update_id').val(update_id);
            $('#submit_btn').val('{{ trans('common.update') }}');
            $('#frontend_modal').modal('show');
        }

        function submit_form(e) {
            e.preventDefault();
            var formData = new FormData($('#frontend_from')[0]);
            console.log(formData);
            var that = this;
            var url = "{{ url('frontend') }}";
            var update_id = $('#update_id').val();
            // alert(update_id);return;
            formData.append('description', $('#description').code());
            if (update_id > 0) {
                url = url + '/' + update_id;
                formData.append('_method', 'PUT');

            }
            // alert(url);

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.error) {
                        swal({
                                title: "Warning!",
                                text: response.msg,
                                type: "warning",
                                confirmButtonText: "OK",
                            },
                            function (isConfirm) {
                                location.reload();
                            });
                    } else {
                        swal({
                                title: "Saved!",
                                text: response.msg,
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

        function new_frontend(e) {
            e.preventDefault();
            $('#frontend_from')[0].reset();
            $('#description').code('');
            $('#update_id').val('');
            $('#submit_btn').val('{{ trans('common.submit') }}');
            $('#frontend_modal').modal('show');
        }
    </script>

@endsection