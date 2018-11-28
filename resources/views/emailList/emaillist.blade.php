@extends('app')

@section('main-content')
    <div class="box box-default">
        <!-- Tabs within a box -->
        <div class="box-header with-border">
            <h3 class="box-title pull-left">
                {{ $group->name. "'s " .trans('common.group') . ' '. trans('common.email-list')}}</h3>
            <button class="btn btn-xs bg-purple pull-right" onclick="addMore()"><i class="fa fa-plus"> {!! trans('common.add_more') !!}</i></button>
        </div>
        <div class="box-body">
            <table class="table table-hover" id="email_list_table">
                <thead>
                <tr class="active">
                    <th class="col-sm-1">#</th>
                    <th>{!! trans('common.name') !!}</th>
                    <th>{!! trans('common.email') !!}</th>
                    <th>{!! trans('common.freeemailverify') !!}</th>
                    <th>{!! trans('common.bulkemailchecker') !!}</th>
                    <th>{!! trans('common.emaillistverify') !!}</th>
                    <th>{!! trans('common.action') !!}</th>
                </tr>
                </thead>
                <tbody>
                
                @foreach($group->emaillist as $key =>$emailList)
                    <tr>
                        <td>{!! $key+1 !!}</td>
                        <td><a class="field_editable" href="#" data-name="name" rel="{{ csrf_token() }}"
                               data-type="text" data-pk="{{ $emailList->id }}"
                               data-url="{{ url('/update_email_info') }}"
                               data-title="Enter Name">{{ $emailList->name }}</a></td>
                        <td style="white-space: nowrap;">
                            <a class="field_editable" href="#" data-name="email" rel="{{ csrf_token() }}"
                               data-type="text" data-pk="{{ $emailList->id }}"
                               data-url="{{ url('/update_email_info') }}"
                               data-title="Enter Email">{{ $emailList->email }}
                            </a>
                            <span class="badge badge-info" data-toggle='tooltip' data-placement='top'
                                  title='{{ $emailList->subscribed == 1 ? trans('common.subscribed') : trans('common.unsubscribed') }}'>
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </span>
                        </td>
                        <td>
                            @if($emailList->free_email_check == 1)
                                <a href="#" data-toggle="modal" class="label label-success"
                                   data-target="#free_email_detail_{{ $emailList->id }}" data-toggle='tooltip'
                                   data-placement='top' title='@lang('common.detail')'> <i class="fa fa-check"></i>
                                </a>
                            @elseif($emailList->free_email_check == 2)
                                <a href="#" data-toggle="modal" class="label label-danger"
                                   data-target="#free_email_detail_{{ $emailList->id }}" data-toggle='tooltip'
                                   data-placement='top' title='@lang('common.detail')'> <i class="fa fa-times"></i>
                                </a>
                            @endif
                        </td>
                        <td>
                            @if($emailList->bulk_check == 1)
                                <a href="#" data-toggle="modal" class="label label-info"
                                   data-target="#bulk_detail_{{ $emailList->id }}" data-toggle='tooltip'
                                   data-placement='top' title='@lang('common.detail')'> <i class="fa fa-check"></i>
                                </a>
                            @elseif($emailList->bulk_check == 2)
                                <a href="#" data-toggle="modal" class="label label-danger"
                                   data-target="#bulk_detail_{{ $emailList->id }}" data-toggle='tooltip'
                                   data-placement='top' title='@lang('common.detail')'> <i class="fa fa-times"></i>
                                </a>
                            @endif
                        </td>
                        <td>
                            @if($emailList->email_list_check == 1)
                                <a href="#" data-toggle="modal" class="label label-info"
                                   data-target="#email_list_detail_{{ $emailList->id }}" data-toggle='tooltip'
                                   data-placement='top' title='@lang('common.detail')'> <i
                                            class="fa fa-check"></i> </i>
                                </a>
                            @elseif($emailList->email_list_check == 2)
                                <a href="#" data-toggle="modal" class="label label-danger"
                                   data-target="#email_list_detail_{{ $emailList->id }}"
                                   data-toggle='tooltip' data-placement='top'
                                   title='@lang('common.detail')'> <i class="fa fa-times"></i> </a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('email-delete/'.$emailList->id) }}"
                               class='btn btn-danger btn-xs delete-swl' data-toggle='tooltip' data-placement='top'
                               title='{{ trans('common.delete') }}'><i class='fa fa-trash-o'></i></a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach($group->emaillist as $key =>$emailList)
        @if(($emailList->bulk_check == 1) || ($emailList->bulk_check == 2))
            <div class="modal fade" id="bulk_detail_{{ $emailList->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="myModalLabel">@lang('common.bulkemailchecker') @lang('common.detail')</h4>
                        </div>
                        <div class="modal-body" style="word-wrap: break-word">
                            {!! str_replace(',', '<br/>', $emailList->bulk_value) !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(($emailList->email_list_check == 1) || ($emailList->email_list_check == 2))
            <div class="modal fade" id="email_list_detail_{{ $emailList->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="myModalLabel">@lang('common.emaillistverify') @lang('common.detail')</h4>
                        </div>
                        <div class="modal-body" style="word-wrap: break-word">
                            {!! str_replace(',', '<br/>', $emailList->email_list_value) !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(($emailList->free_email_check == 1) || ($emailList->free_email_check == 2))
            <div class="modal fade" id="free_email_detail_{{ $emailList->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="myModalLabel">@lang('common.bulkemailchecker') @lang('common.detail')</h4>
                        </div>
                        <div class="modal-body" style="word-wrap: break-word">
                            {!! str_replace(',', '<br/>', $emailList->free_email_value) !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <script>
        var newRow = 1;

        $(function () {
            $('.field_editable').editable({
                params: function (params) {
                    params._token = $(this).attr('rel');
                    return params;
                },
                ajaxOptions: {
                    success: function (data) {
                        swal({
                                    title: data.type,
                                    text: data.msg,
                                },
                                function () {
                                    window.location.reload();
                                });
                    }
                }
            });
        });

        function addMore() {
            var t = $('#email_list_table').DataTable();
            t.row.add([
                0,
                '<input class="input-sm form-control" id="new-name-' + newRow + '" name="name" type="text">',
                '<input class="form-control" name="email" id="new-email-' + newRow + '" type="text">',
                '<button class="btn btn-success btn-xs" onclick="saveNewEmail(' + newRow + ')" data-toggle="tooltip" data-placement="top" title="{{ trans('common.save') }}"><i class="fa fa-send-o"></i></button> ',
                '',
                '',
                ''
            ]).draw();
            newRow++;
        }

        function saveNewEmail(rowIndex) {
            var group_id = "{{ $group->id }}";
            var name = $('#new-name-' + rowIndex).val();
            var email = $('#new-email-' + rowIndex).val();
            if (typeof email !== 'undefined') {
                if (typeof name === 'undefined') {
                    name = '';
                }

                $.ajax({
                    url: "{{ url('save-email') }}",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        email: email,
                        group_id: group_id
                    },
                    success: function (data) {
                        if (data.type) {
                            swal({
                                title: "Congrats",
                                text: data.msg,
                                type: "success",
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "OK",
                                closeOnConfirm: false

                            }, function (result) {
                                if (result) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            swal("Warning", data.msg, "warning");
                        }
                    },
                    error: {}
                });
            } else {
                swal('Email field is required.');
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            var export_filename = '{{ request()->segment(1) }}';

            $('#email_list_table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Copy',
                        extend: 'copy',
                        exportOptions: {
                            columns: [0,1,2]
                        }
                    }, {
                        text: 'CSV',
                        extend: 'csvHtml5',
                        title: export_filename,
                        extension: '.csv',
                        exportOptions: {
                            columns: [0,1,2]
                        }
                    }, {
                        text: 'XLS',
                        extend: 'excelHtml5',
                        title: export_filename,
                        extension: '.xls',
                        exportOptions: {
                            columns: [0,1,2]
                        }
                    }, {
                        text: 'PDF',
                        extend: 'pdf',
                        title: export_filename,
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0,1,2]
                        }
                    }, {
                        text: 'Print',
                        extend: 'print',
                        exportOptions: {
                            columns: [0,1,2]
                        }
                    }
                ]
            });
        });   
    </script>

@endsection