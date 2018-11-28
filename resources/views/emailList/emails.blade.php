@extends('app')
@section('main-content')
<div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title pull-left">
                {{ $group_name. "'s " .trans('common.group') . ' '. trans('common.email-list')}}</h3>
            <button class="btn btn-xs bg-purple pull-right" onclick="addMore()"><i class="fa fa-plus"> {!! trans('common.add_more') !!}</i></button>
        </div>
        <div class="box-body">
            <table class="table table-hover" style="width:100%" id="emails">
                    <thead>
                        <tr class="active">
                            @foreach($table_headings as $key=>$value)
                                <th class="col-sm-1">{{ $value }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>                		
            </table>
        </div>  
</div>
@foreach($emaillists as $emailList)
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

<style>
/* <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/> */
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
</style>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script> -->
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    var newRow = 1;
   

    function addMore(){
        $('#emails > tbody:last-child').prepend(
            '<tr id="newRow'+newRow+'">'// need to change closing tag to an opening `<tr>` tag.
            +'<td>'+newRow+'</td>'
            +'<td><input class="input-sm form-control" id="new-name-' + newRow + '" name="name" type="text"></td>'
            +'<td><input class="form-control" name="email" id="new-email-' + newRow + '" type="text"></td>'
            +'<td><button class="btn btn-success btn-xs" onclick="saveNewEmail(' + newRow + ')" data-toggle="tooltip" data-placement="top" title="{{ trans('common.save') }}"><i class="fa fa-send-o"></i></button> <button class="fa fa-trash-o btn btn-danger" onClick="newRowDelete('+newRow+')"></button></td>'
            +'<td></td>'
            +'<td></td>'
            +'<td></td>'
            +'</tr>');
        newRow++;
    }

    function saveNewEmail(rowIndex) {
            var group_id = "{{ $group_id }}";
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

    function newRowDelete(rowId){
        var rowId = rowId;
        $('#newRow'+rowId).remove();
    }


    function callEditableBootstrap(){
       
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
    }
    function deleteSwl(){
            $('.delete-swl').click(function(e){
            
            e.preventDefault();
            var text = "You will not be able to recover this!";

            if($(this).data('msg')) {
                text = $(this).data('msg');
            }

            var href = $(this).attr('href');
            var that = this;

            swal({
                title: "Are you sure?",
                text: text,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false

            }, function(result){
                if(result){
                    if(typeof href !== 'undefined'){
                        window.location.href = href;
                    } else {
                        $(that).closest("form").submit();
                    }
                }
            });
        });
    }
    $(document).ready(function () {
      var col = {!! $db_columns !!};
     
      $.ajaxSetup({
        async: false
        });
    
        $('#emails').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('allemails') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{ csrf_token() }}", group_id: "{{ $email_list }}"},
                    
                   },
            "columns": col
                
        });
        $.ajaxSetup({
        async: true
        });

        callEditableBootstrap();
        deleteSwl();
    });

    $(function(){

        $( document ).ajaxComplete(function() {
            callEditableBootstrap();
            deleteSwl();
        });

       
    });
</script>


@endsection