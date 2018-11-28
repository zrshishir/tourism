@extends('app')

@section('main-content')
    <style>
        .message {
            margin-left: 55px;
            margin-top: -40px;
        }
        .name {
            display: block;
            font-weight: 600;
        }
        .chat .item {
            margin-bottom: 10px;
        }
        .mt {
            margin-top: 10px !important;
        }
    </style>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-3">
                    <div class="box box-default" style="margin-top: 0px">
                        <!-- Tabs within a box -->
                        <div class="box-header with-border">
                            <h5 class="box-title pull-left">
                                {{ trans('common.all').' '.trans('tickets.tickets') }}
                            </h5>
                                <a style="margin-top: -5px" href="{{ url('tickets') }}" data-original-title="{{ trans('common.new'). ' ' .trans('tickets.ticket') }}" data-toggle="tooltip" data-placement="top" class="btn btn-icon btn- btn-sm pull-right"><i class="fa fa-plus"></i></a>
                        </div>
                        <div class="box-body">
                            <section class="scrollable  ">
                                <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                                    @foreach($tickets as $tick)
                                        <ul class="nav">                                    
                                            <li class="active">
                                                <a href="{{ url('tickets/'.$tick->id) }}">
                                                    {{ $tick->code }}
                                                    <div class="pull-right">
                                                        <span class="label label-danger">{{ $tick->ticket_status->status }}</span>
                                                    </div>
                                                    <br>
                                                    <small class="block small text-muted">
                                                        {{ date('d-m-Y', strtotime($tick->created_at)) }}
                                                    </small>
                                                </a>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <section class="col-sm-9">
                    <header class="hidden-print">
                        <div class="row ">
                            <div class="col-sm-12">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['tickets.destroy', $ticket->id], 'class' => 'delete-form']) !!}
                                    <a class="btn btn-purple btn-sm" id="tab_collapse"><i class="fa fa-caret-left"></i></a>
                                    
                                    <a href="" onclick="edit_ticket(event, '{{ $ticket->id }}')" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i></a>
                                    
                                    <button class='btn btn-danger btn-sm delete-swl' data-toggle='tooltip' data-placement='top' title="{{ trans('common.delete') }}"><i class='fa fa-trash-o'></i></button>
                                    
                                    <!-- <a href="http://hrm-crm.uniquecoder.com/admin/tickets/delete/delete_tickets/1" class="btn btn-danger btn-sm" title="" data-toggle="tooltip" data-placement="top" onclick="return confirm('You are about to delete a record. This cannot be undone. Are you sure?');" data-original-title="Delete"><i class="fa fa-trash-o"></i></a> -->
                                
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown"> 
                                            {{ trans('common.change').' '.trans('common.status') }} <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu animated zoomIn">
                                            @foreach($ticket_status as $tic_sta)
                                                <li>
                                                    <a href="{{ url('tickets/change_status/'.$ticket->id.'/'.$tic_sta->id) }}">
                                                        {{ $tic_sta->status }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                    
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </header>
                    <!-- Start Display Details -->
                    <div class="row mt" style="margin-top: 10px !important;">
                        <div class="col-lg-4 hide" id="list_tab">
                            <ul class="list-group no-radius">
                                <li class="list-group-item"> {{ trans('tickets.reporter') }} 
                                    <span class="pull-right">
                                        <a class="recect_task pull-left">
                                            <img style="width: 18px;margin-left: 18px;
                                             height: 18px;
                                             border: 1px solid #aaa;" src="http://hrm-crm.uniquecoder.com/uploads/admin.png" class="img-circle">
                                            {{ user_or_customer_info($ticket->reporter, 'name') }}
                                        </a>
                                    </span>
                                </li>

                                <li class="list-group-item">
                                    <span class="pull-right"> {{ $ticket->department->name }} </span>
                                    {{ trans('tickets.department') }}
                                </li>
                                <li class="list-group-item">
                                    <span class="pull-right">
                                        <label class="label label-danger">{{ $ticket->ticket_status->status }}</label>
                                    </span>
                                    {{ trans('common.status') }}
                                </li>
                                <li class="list-group-item">
                                    <span class="pull-right">{{ ucwords($ticket->priority) }}</span>
                                    {{ trans('tickets.priority') }}
                                </li>
                                <li class="list-group-item">
                                    <span class="pull-right">{{ $ticket->created_at }}</span>
                                    {{ trans('common.created') }}
                                </li>
                            </ul>
                        </div>
                        <!-- End details C1-->
                        <div class="col-sm-12" id="tab">
                            <div class="box box-default" style="margin-top: 0px">
                                <!-- Tabs within a box -->
                                <div class="box-header with-border">
                                    <h4 class="box-title pull-left">
                                        [ {{ $ticket->code }} ] {{ $ticket->subject }}
                                    </h4>
                                </div>
                                <div class="box-body">
                                    {{ $ticket->reason }}
                                    
                                    <ul class="mailbox-attachments clearfix mt">
                                        @foreach(json_decode($ticket->attachments) as $attach_key => $attachment)
                                            <li>
                                                @if(file_image_check(mime_content_type(base_path('public/upload/'.$attachment))))
                                                    <span class="mailbox-attachment-icon has-img">
                                                        <img src="{{ asset('upload/'.$attachment) }}">
                                                    </span>
                                                @else
                                                    <span class="mailbox-attachment-icon">
                                                        <i class="fa fa-file"></i>
                                                    </span>
                                                @endif

                                                <div class="mailbox-attachment-info">
                                                    <a href="{{ url('tickets/attchment-download/'.$attachment) }}" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{ $attach_key }}</a>
                                                    <span class="mailbox-attachment-size">
                                                        {{ formatSizeUnits(filesize(base_path('public/upload/'.$attachment))) }}
                                                        <a href="{{ url('tickets/attchment-download/'.$attachment) }}" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                                
                                            </li>
                                        @endforeach
                                    </ul>
                                    
                                    <button data-toggle="collapse" data-target="#topic-reply" class="btn btn-primary mb mt collapsed" aria-expanded="false">{{ trans('tickets.reply').' '.trans('tickets.ticket') }}</button>
                                    
                                    <div id="topic-reply" class="collapse" aria-expanded="false" style="height: 0px;">
                                        <form method="post" enctype="multipart/form-data" action="{{ url('tickets/comment_save') }}">

                                            {{ csrf_field() }}

                                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                            <div class="form-group col-sm-12">
                                                <textarea class="form-control no-border" name="comments" rows="3" placeholder="{{ trans('tickets.ticket').' #'. $ticket->code.' '.trans('tickets.reply') }}"></textarea>
                                            </div>
                                            <div id="add_new_comment">
                                                <div class="form-group">
                                                    <div class="col-sm-8">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">

                                                            <span class="btn btn-default btn-file">
                                                                <span class="fileinput-new">Select File</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="file" name="comment_files[]">
                                                            </span>
                                                            <span class="fileinput-filename"></span>
                                                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">×</a>
                                                        </div>
                                                        <div id="msg_pdf" style="color: #e11221"></div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <strong><a href="javascript:void(0);" id="add_more_comment" class="addCF "><i class="fa fa-plus"></i>&nbsp;Add More                                                </a></strong>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group panel-footer ">

                                                <button class="btn btn-info pull-right btn-sm mt" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <hr>
                                    <div class="col-sm-12 item mt">
                                        @foreach($ticket_comments as $key => $comment)
                                            @if (user_or_customer_info($comment->user_id, 'photo') && (user_or_customer_info($comment->user_id, 'photo') != ''))
                                                @if(strpos(user_or_customer_info($comment->user_id, 'photo'), 'http') !== false)
                                                    <img src="{{ user_or_customer_info($comment->user_id, 'photo') }}" class="img-xs img-circle" style="width: 32px !important; height: :32px !important;" alt="User Image"/>
                                                @else
                                                    <img src="{{ url('upload/'.user_or_customer_info($comment->user_id, 'photo')) }}" class="img-xs img-circle" style="width: 32px !important; height: :32px !important;" alt="User Image"/>
                                                @endif
                                            @else
                                                <img src="{{ url('img/user2-160x160.jpg') }}" class="img-xs img-circle" style="width: 32px !important; height: :32px !important;" alt="User Image"/>
                                            @endif

                                            <p class="message ">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 
                                                    {{ $comment->created_at }} 
                                                    <a href="{{ url('tickets/comment_delete/'. $comment->id) }}" class="btn btn-danger btn-xs delete-swl" title="" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('common.delete') }}"><i class="fa fa-trash-o"></i></a>
                                                </small>
                                                <a href="#" class="name">
                                                    {{ user_or_customer_info($comment->user_id, 'name') }} 
                                                </a> 
                                                    {{ $comment->comments }}
                                                
                                                @foreach(json_decode($comment->attachments) as $attach_key => $attachment)
                                                    @if(file_image_check(mime_content_type(base_path('public/upload/'.$attachment))))
                                                        <span class="file-icon block mt">
                                                            <a href="{{ url('tickets/attchment-download/'.$attachment) }}">
                                                                <img style="width: 50px;border-radius: 5px;" src="{{ asset('upload/'.$attachment) }}">
                                                            </a>
                                                        </span>
                                                    @else
                                                        <span class="file-icon block mt">
                                                            <a class="btn btn-default btn-file" href="{{ url('tickets/attchment-download/'.$attachment) }}"><i class="fa fa-file-o"></i> 
                                                                {{ $attach_key }}
                                                            </a>
                                                        </span>
                                                    @endif
                                                @endforeach
                                                <br>
                                            </p>
                                        @endforeach
                                    </div>
                                </div><!-- /.panel body -->
                            </div>
                        </div>
                        <!-- End ticket replies -->
                    </div>
                </section>
            </div>
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
    <script type="text/javascript">
        $(document).ready(function () {
            var maxAppend = 0;
            $("#add_more_comment").click(function () {

                var add_new = $('<div class="form-group" style="margin-bottom: 0px">\n\
            <div class="col-sm-8">\n\
            <div class="fileinput fileinput-new" data-provides="fileinput">\n\
    <span class="btn btn-default btn-file"><span class="fileinput-new" >Select File</span><span class="fileinput-exists" >Change</span><input type="file" name="comment_files[]" ></span> <span class="fileinput-filename"></span><a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a></div></div>\n\<div class="col-sm-4">\n\<strong>\n\
    <a href="javascript:void(0);" class="remCF"><i class="fa fa-times"></i>&nbsp;{!! trans('common.remove') !!}</a></strong></div>');
                maxAppend++;
                $("#add_new_comment").append(add_new);

            });

            $("#add_new_comment").on('click', '.remCF', function () {
                $(this).parent().parent().parent().remove();
            });
            $('a.RCF').click(function () {
                $(this).parent().parent().remove();
            });
        });
    </script>

    <script>
        var previous_attach = {};

        var uploaded_file = "{!! trans('common.uploaded_file') !!}";
        var select_file = "{!! trans('common.select_file') !!}";
        var change_text = "{!! trans('common.change') !!}";

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