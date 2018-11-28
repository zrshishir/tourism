@extends('app')

@section('main-content')
    
    <div class="ajax-overlay"><p><i class="fa fa-spin fa-refresh fa-5x"></i></p></div>
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li @if ((count($errors) > 0) || isset($groupList) || count($groups) == 0) class="" @else class="active" @endif ><a href="#allEmailList"
                                                                                                   data-toggle="tab">
                    {{ trans('common.all') . ' '. trans('common.email-list')}}</a></li>
            @if(Auth::user() || isset($groupList) )
                <li @if ((count($errors) > 0) || isset($groupList) || count($groups) == 0) class="active" @else class="" @endif ><a
                            href="#eamilList"
                            data-toggle="tab">{{ $title }}</a>
                </li>
            @endif
        </ul>
        <div class="tab-content no-padding">
            <!-- ************** general *************-->
            <div @if ((count($errors) > 0) || isset($groupList) || count($groups) == 0) class="tab-pane" @else class="tab-pane active"
                 @endif id="allEmailList">

                <table class="table table-hover" id="dataTables">
                    <thead>
                    <tr class="active">
                        <th class="col-sm-1">#</th>
                        <th>{!! trans('common.name') !!}</th>
                        <th>{!! trans('common.freeemailverify') !!}</th>
                        <th>{!! trans('common.bulkemailchecker') !!}</th>
                        <th>{!! trans('common.emaillistverify') !!}</th>
                        <th>{!! trans('common.action') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($groups) > 0)
                        @foreach($groups as $key =>$group)
                            <tr>
                                <td><a href="{{ url('email-list/'.$group->id) }}" data-toggle='tooltip' data-placement='top' title='{{ trans('common.detail') }}'>{!! $key+1 !!}</a></td>
                                <td><a href="{{ url('email-list/'.$group->id) }}" data-toggle='tooltip' data-placement='top' title='{{ trans('common.detail') }}'>{{ $group->name }}</a> <span class="badge" data-toggle='tooltip' data-placement='top' title='{{ trans('common.email') }}'>{{ isset($emailListCountData[$group->id]) ? $emailListCountData[$group->id] : 0 }}</span></td>

                               {{--email valid check--}}
                                <td>
                                    @if($group->free_email_check == 1)
                                        <span class="label label-warning"><i class="fa fa-calendar" data-toggle='tooltip' data-placement='top' title='{{ trans('common.checked_at'). ' ' . date('d-m-Y', $group->free_email_check_date) }}'></i></span>
                                        <span class="badge badge-success" data-toggle='tooltip' data-placement='top' title='{{ trans('common.valid') }}'>{{ validEmailNumber($group->id, 'free_email_check') }}</span>
                                        <span class="badge badge-danger" data-toggle='tooltip' data-placement='top' title='{{ trans('common.invalid') }}'>{{ invalidEmailNumber($group->id, 'free_email_check') }}</span>
                                        <a class="free_email_swl btn btn-info btn-xs" href='{{ url("real-email/freeemailverify/$group->id") }}' data-toggle='tooltip' data-placement='top' title='{{ trans('common.recheck') }}'><i class="fa fa-check" aria-hidden="true"></i></a>
                                        <a class="del_inv_swl btn btn-danger btn-xs" href='{{ url("delete-invalid-email/free_email_check/$group->id") }}' data-toggle='tooltip' data-placement='top' title='{{ trans('common.delete_invalid_email') }}'><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    @else
                                        <a class="free_email_swl btn btn-info btn-xs" href='{{ url("real-email/freeemailverify/$group->id") }}' data-toggle='tooltip' data-placement='top' title='{{ trans('common.validate') }}'><i class="fa fa-check" aria-hidden="true"></i></a>
                                    @endif
                                    @if($group->status = 1)
                                        <span class="label label-success">{!! trans('common.active') !!}</span>
                                    @elseif($group->status = 0)
                                        <span class="label label-danger">{!! trans('common.inactive') !!}</span>
                                    @endif
                                </td>

                                {{--bulk email verify api--}}

                                <td>
                                    @if($group->bulk_check == 1)
                                        <span class="label label-warning"><i class="fa fa-calendar" data-toggle='tooltip' data-placement='top' title='{{ trans('common.checked_at'). ' ' . date('d-m-Y', $group->bulk_check_date) }}'> </i> </span>
                                        <span class="badge badge-success" data-toggle='tooltip' data-placement='top' title='{{ trans('common.valid') }}'>{{ validEmailNumber($group->id, 'bulk_check') }}</span>
                                        <span class="badge badge-danger" data-toggle='tooltip' data-placement='top' title='{{ trans('common.invalid') }}'>{{ invalidEmailNumber($group->id, 'bulk_check') }}</span>
                                        <a class="chk_swl btn btn-info btn-xs" id='https://bulkemailchecker.com' href='{{ url("real-email/bulkemailchecker/$group->id") }}' data-toggle='tooltip' data-placement='top' title='{{ trans('common.recheck') }}'><i class="fa fa-check" aria-hidden="true"></i></a>
                                        <a class="del_inv_swl btn btn-danger btn-xs" href='{{ url("delete-invalid-email/bulk_check/$group->id") }}' data-toggle='tooltip' data-placement='top' title='{{ trans('common.recheck') }}'><i class="fa fa-check" aria-hidden="true"></i></a>
                                    @else
                                        <a class="chk_swl btn btn-info btn-xs" id='https://bulkemailchecker.com' href='{{ url("real-email/bulkemailchecker/$group->id") }}' data-toggle='tooltip' data-placement='top' title='{{ trans('common.validate') }}'><i class="fa fa-check" aria-hidden="true"></i></a>
                                    @endif
                                </td>

                                {{--email list verify api--}}
                                <td>
                                    @if($group->email_list_check == 1)
                                        <span class="label label-warning"><i class="fa fa-calendar" data-toggle='tooltip' data-placement='top' title='{{ trans('common.checked_at'). ' ' . date('d-m-Y', $group->email_list_verify_date) }}'> </i> </span>
                                        <span class="badge badge-success" data-toggle='tooltip' data-placement='top' title='{{ trans('common.valid') }}'>{{ validEmailNumber($group->id, 'email_list_check') }}</span>
                                        <span class="badge badge-danger" data-toggle='tooltip' data-placement='top' title='{{ trans('common.invalid') }}'>{{ invalidEmailNumber($group->id, 'email_list_check') }}</span>
                                        <a class="chk_swl btn btn-info btn-xs" id='https://app.emaillistverify.com' href='{{ url("real-email/emaillistverify/$group->id") }}' data-toggle='tooltip' data-placement='top' title='{{ trans('common.recheck') }}'><i class="fa fa-check" aria-hidden="true"></i></a>
                                        <a class="del_inv_swl btn btn-danger btn-xs" href='{{ url("delete-invalid-email/email_list_check/$group->id") }}' data-toggle='tooltip' data-placement='top' title='{{ trans('common.recheck') }}'><i class="fa fa-check" aria-hidden="true"></i></a>
                                    @else
                                        <a class="chk_swl btn btn-info btn-xs" id='https://app.emaillistverify.com' href='{{ url("real-email/emaillistverify/$group->id") }}' data-toggle='tooltip' data-placement='top' title='{{ trans('common.validate') }}'><i class="fa fa-check" aria-hidden="true"></i></a>
                                    @endif
                                </td>

                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['email-list.destroy', $group->id], 'class' => 'delete-form']) !!}
                                    <a href="#" class="btn btn-xs btn-warning" data-placement='top' title="{{ trans('common.subscribe'). '  ' . trans('common.link') }}" data-toggle="modal" data-target="#subscribe_link_{{ $key }}"><i class="fa fa-link"></i></a>
                                    {!! btn_show("email-list/$group->id") !!}
                                    {!! btn_edit("email-list/$group->id/edit") !!}
                                    {!! btn_delete_submit_group() !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div @if ((count($errors) > 0) || isset($groupList) || count($groups) == 0) class="tab-pane active" @else class="tab-pane"
                 @endif id="eamilList">

                @if( !isset($groupList) )
                    {!! Form::open(['url' => "email-list",'id'=>'email-list','class'=>'form-horizontal send-email-form', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                    @include('emailList._form',['submit_button' => 'Submit'])

                    {!! Form::close() !!}
                @else
                    {!! Form::model($groupList,['method' =>'PUT', 'url' => ["email-list",$groupList->id],'id'=>'email-list','class'=>'form-horizontal send-email-form', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes', 'files' => true]) !!}

                    @include('emailList._form',['submit_button' => 'Update'])

                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

    @foreach($groups as $key => $group)
        <div class="modal fade" id="subscribe_link_{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{ trans('common.subscribe'). '  ' . trans('common.link') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-2 col-md-offset-4">
                            <span class="label label-primary">{{ $group->name . ' ' . trans('common.group')}} </span><br><br>
                        </div>
                            <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="input-group">
                                <input class="form-control" id="subscribe_value_{{ $key }}" onclick="select_link('{{ 'subscribe_value_'. $key }}')" value="{{ url('/subscribe/'. Auth::user()->api_key . '/' . base64_encode($group->id)) }}">
                                <div class="input-group-addon"><a href="" onclick="copied_link(event, '{{ 'subscribe_value_' . $key }}')" data-toggle='tooltip' data-placement='top' title='{{ trans('common.click_here_to_copy_link') }}'><i class="fa fa-copy"></i></a></div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <style>
        .badge-success {
            background-color: #398439;
        }

        .badge-danger {
            background-color: #d43f3a;
        }
    </style>
    <script>

       $('input[type="file"]').change(function(){
           var iniFileSize = '{{ $iniFileSize }}';
           var filesize = (this.files[0].size/1024/1024);
           var fileSize = filesize.toFixed(2);
           var link_text = '';

           if(fileSize > iniFileSize){
               link_text = 'Your file size '+ fileSize +  'M is more than your server max file size '+iniFileSize+'M, please increase your server max file size or reduce your file size.';
               swal({
                    title: "Max File Size Info!",
                    text: link_text,
                    type: "warning",
                    closeOnConfirm: true,
                    html: true

                }, function(result){
                    if(result){
                        $('input[type="file"]').val("");
                        if(typeof href !== 'undefined'){
                            window.location.href = href;
                        }
                    }
                });
           }

        });

        $('.send-email-form').submit(function(e) {
            //            e.preventDefault();
            // $('.ajax-overlay').show();
            // return true;
            
            var $loading = $('.loader');

            $('#body_content').css('opacity', '0.5');
            $loading.show();

        });

        $(function (){

            $('.chk_swl').click(function(e){
                e.preventDefault();
                var href = $(this).attr('href');
                var link = $(this).attr('id');
                var link_text = '';
                if (link.indexOf("bulkemailchecker") >= 0) {
                    var link_text = "Please make sure you have enough credit at <a target='_blank' href='" + link + "'>bulkemailchecker</a>!";
                } else if (link.indexOf("emaillistverify") >= 0){
                    var link_text = "Please make sure you have enough credit at <a target='_blank' href='" + link + "'>emaillistverify</a>!";
                }
                    var that = this;

                swal({
                    title: "This is paid service !",
                    text: link_text,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false,
                    html: true

                }, function(result){
                    if(result){
                        if(typeof href !== 'undefined'){
                            window.location.href = href;
                        }
                    }
                });
            });

            $('.del_inv_swl').click(function(e){
                e.preventDefault();
                var href = $(this).attr('href');
                var that = this;

                swal({
                    title: "Are you sure?",
                    text: "Delete Invalid Email",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Delete",
                    closeOnConfirm: false,
                    html: true

                }, function(result){
                    if(result){
                        if(typeof href !== 'undefined'){
                            window.location.href = href;
                        }
                    }
                });
            });

            $('.free_email_swl').click(function(e){
                e.preventDefault();
                var href = $(this).attr('href');
                var that = this;

                swal({
                    title: "Are you sure?",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false,
                    html: true

                }, function(result){
                    if(result){
                        if(typeof href !== 'undefined'){
                            window.location.href = href;
                        }
                    }
                });
            });
        });

        function copied_link(e, link){
            e.preventDefault();
            copyToClipboard(document.getElementById(link));
        }

        function copyToClipboard(elem) {
            // create hidden text element, if it doesn't already exist
            var targetId = "_hiddenCopyText_";
            var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
            var origSelectionStart, origSelectionEnd;
            if (isInput) {
                // can just use the original source element for the selection and copy
                target = elem;
                origSelectionStart = elem.selectionStart;
                origSelectionEnd = elem.selectionEnd;
            } else {
                // must use a temporary form element for the selection and copy
                target = document.getElementById(targetId);
                if (!target) {
                    var target = document.createElement("textarea");
                    target.style.position = "absolute";
                    target.style.left = "-9999px";
                    target.style.top = "0";
                    target.id = targetId;
                    document.body.appendChild(target);
                }
                target.textContent = elem.textContent;
            }
            // select the content
            var currentFocus = document.activeElement;
            target.focus();
            target.setSelectionRange(0, target.value.length);

            // copy the selection
            var succeed;
            try {
                succeed = document.execCommand("copy");
            } catch(e) {
                succeed = false;
            }
            // restore original focus
            if (currentFocus && typeof currentFocus.focus === "function") {
                currentFocus.focus();
            }

            if (isInput) {
                // restore prior selection
                elem.setSelectionRange(origSelectionStart, origSelectionEnd);
            } else {
                // clear temporary content
                target.textContent = "";
            }
            return succeed;
        }

        function select_link(id){
            $('#'+id).select();
        }

    </script>
@endsection