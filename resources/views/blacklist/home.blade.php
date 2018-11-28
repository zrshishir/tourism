@extends('app')

@section('main-content')

    <div class="box box-default" style="margin-top: 0px">
        <!-- Tabs within a box -->
        <div class="box-header with-border">
            <h3 class="box-title pull-left">
                {{ $pageName }}
            </h3>
            <a href="" onclick="new_blacklist(event)"
               class="pull-right">{{ trans('common.new').' '.$pageName}}</a>
        </div>
        <div class="box-body">
            <table class="table table-hover" id="blacklist-table">
                <thead>
                <tr class="active">
                    <th class="col-sm-1">#</th>
                    <th>{{ trans('blacklist.'.explode("_",request()->segment(1))[0]).' '.trans('common.list') }}</th>
                    <th>{{ trans('common.reason') }}</th>
                    <th>{{ trans('blacklist.set_by') }}</th>
                    <th>{{ trans('common.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($blacklist as $key =>$v_blacklist)
                    <tr>
                        <td>{!! $key+1 !!}</td>
                        <td>{{ $v_blacklist->name }}</td>
                        <td>
                            {{ $v_blacklist->reason }}
                        </td>
                        <td>
                            @if(superadmin('id') == $v_blacklist->created_by)
                                <span class="label label-success"> {{ trans('common.super_admin') }} </span>
                            @else
                                <span class="label label-primary"> {{ trans('common.customer') }} </span>
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['email_blacklist.destroy', $v_blacklist->id], 'class' => 'delete-form']) !!}
                            <a href="" onclick="edit_blacklist(event, '{{ $v_blacklist->id }}')"
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

    <div class="modal fade" id="blacklist" tabindex="-1" role="dialog"
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
                    {!! Form::open(['url' => "blacklist",'id'=>'blacklist_form','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                    @include('blacklist.form',['submit_button' => 'Submit'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var export_filename = '{{ request()->segment(1) }}';

            $('#blacklist-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Copy',
                        extend: 'copy',
                        exportOptions: {
                            columns: [0,1,2,3]
                        }
                    }, {
                        text: 'CSV',
                        extend: 'csvHtml5',
                        title: export_filename,
                        extension: '.csv',
                        exportOptions: {
                            columns: [0,1,2,3]
                        }
                    }, {
                        text: 'XLS',
                        extend: 'excelHtml5',
                        title: export_filename,
                        extension: '.xls',
                        exportOptions: {
                            columns: [0,1,2,3]
                        }
                    }, {
                        text: 'PDF',
                        extend: 'pdf',
                        title: export_filename,
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0,1,2,3]
                        }
                    }, {
                        text: 'Print',
                        extend: 'print',
                        exportOptions: {
                            columns: [0,1,2,3]
                        }
                    }
                ]
            });
        });        

        function edit_blacklist(e, id) {
            e.preventDefault();
            var update_id = id;
            var url = "{{ url('email_blacklist') }}";
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
                            if(key == 'user_id' && value) {
                                $('#select_customer').select2('val', $.parseJSON(value));
                            } else {
                                $('#' + key).val(value);
                            }
                        });
                    }
                },
            });

            $('#update_id').val(update_id);
            $('#submit_btn').val('{{ trans('common.update') }}');
            $('#blacklist').modal('show');

            
        }

        function submit_form(e) {
            e.preventDefault();
            var formData = new FormData($('#blacklist_form')[0]);
            var that = this;
            var url = "{{ url('email_blacklist') }}";
            var update_id = $('#update_id').val();
            // alert(update_id);return;
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

        function new_blacklist(e) {
            e.preventDefault();
            $('#blacklist_form')[0].reset();
            $('#blacklist').modal('show');
        }
    </script>

@endsection