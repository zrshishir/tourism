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
                    <th>{{ trans('tickets.code') }}</th>
                    <th>{{ trans('tickets.subject') }}</th>
                    <th>{{ trans('tickets.reporter') }}</th>
                    <th>{{ trans('tickets.department') }}</th>
                    <th>{{ trans('common.status') }}</th>
                    <th>{{ trans('common.action') }}</th>
                    
                </tr>
                </thead>
                <tbody>
                @if(isset($tickets))
                    @foreach($tickets as $key =>$ticket)
                        <tr>
                            <td>{{ $ticket->code }}</td>
                            <td>{{ $ticket->subject }}</td>
                            <td>
                                {{ user_or_customer_info($ticket->reporter, 'email') }}
                            </td>
                            <td>
                                {{ $ticket->department->name }}
                            </td>
                            <td>
                                {{ $ticket->ticket_status->status }}
                            </td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['tickets.destroy', $ticket->id], 'class' => 'delete-form']) !!}
                                {!! btn_show(url("tickets/$ticket->id")) !!}
                                <a href="" onclick="edit_ticket(event, '{{ $ticket->id }}')"
                                   class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                {!! btn_delete_submit() !!}

                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="ticket" tabindex="-1" role="dialog"
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
                    {!! Form::open(['url' => "tickets",'id'=>'ticket_form','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                    @include('Tickets.form',['submit_button' => 'Submit'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script>

    var previous_attach = {};

    var uploaded_file = "{!! trans('common.uploaded_file') !!}";
    var select_file = "{!! trans('common.select_file') !!}";
    var change_text = "{!! trans('common.change') !!}";

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

        function edit_ticket(e, id) {
            e.preventDefault();
            var update_id = id;
            var url = "{{ url('tickets') }}";
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
                            if(key == 'attachments'){
                                var attach_html = '';
                                $.each($.parseJSON(value), function(attach_key, attach_value) {
                                    console.log(attach_value);
                                    attach_html += '<div class="form-group" style="margin-bottom: 0px">'+
                                        '<label for="field-1" class="col-sm-3 control-label">'+ uploaded_file +'</label>'+
                                            '<div class="col-sm-5">'+
                                                '<div class="fileinput fileinput-exists" data-provides="fileinput">'+
                                                    
                                                    '<span class="btn btn-default btn-file"><span class="fileinput-new">' + select_file + '</span>'+
                                                        '<span class="fileinput-exists" onclick="remove_attach(\''+ attach_value +'\')">'+ change_text +'</span>'+
                                                        '<input type="hidden" name="" value="">'+
                                                        '<input type="file" name="upload_file[]">'+
                                                    '</span>'+
                                                    '<span class="fileinput-filename">'+ attach_key +'</span>'+
                                                    
                                                    '<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;" onclick="remove_attach(\''+ attach_value +'\')">×</a>'+
                                                '</div>'+
                                                '<div id="msg_pdf" style="color: #e11221"></div>'+
                                            '</div>'+
                                            '<div class="col-sm-2"></div>'+
                                        '</div>';
                                });

                                if(attach_html) {
                                    previous_attach = $.parseJSON(value);

                                    $('#edit_attach').html(attach_html);
                                    $('#edit_attach').show();
                                }

                            } else if(key == 'reporter' || key == 'priority' || key == 'department_id') {
                                if($('#'+key).length > 0) {
                                    $('#'+key).select2('val', value);
                                }
                            } else {
                                $('#' + key).val(value);
                            }
                        });

                    }
                },
            });

            $('#update_id').val(update_id);
            $('#submit_btn').val('{{ trans('common.update') }}');
            $('#ticket').modal('show');

            
        }

        function remove_attach(attach_name) {
            var temp_pre_attach = Object.assign({}, previous_attach);

            previous_attach = {};

            $.each(temp_pre_attach, function(attach_key, attach_value) {
                if(attach_value != attach_name) {
                    previous_attach[attach_key] = attach_value;
                }
            });

        }


        function submit_form(e) {
            e.preventDefault();
            var formData = new FormData($('#ticket_form')[0]);
            var that = this;
            var url = "{{ url('tickets') }}";
            var update_id = $('#update_id').val();
            // alert(update_id);return;
            if (update_id > 0) {
                url = url + '/' + update_id;
                formData.append('_method', 'PUT');
                
                formData.append('previous_attach', JSON.stringify(previous_attach));
                
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
            $('#ticket_form')[0].reset();
            $('#ticket').modal('show');
        }
    </script>

@endsection