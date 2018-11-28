@extends('app')

@section('main-content')
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li class="{{ ((count($errors) > 0) || isset($attachInfo) || count($attachments) == 0) ? '' : 'active' }}"><a href="#all_attachments"
                                                                                                  data-toggle="tab">{{ trans('common.all_attachments') }}</a></li>
            <li class="{{ ((count($errors) > 0) || isset($attachInfo) || count($attachments) == 0) ? 'active' : '' }}"><a href="#manage_attachment"
                                                                                                      data-toggle="tab">{{ $add_edit_title }}</a>
            </li>
        </ul>
        <div class="tab-content no-padding">
            <!-- ************** general *************-->
            <div @if ((count($errors) > 0) || isset($attachInfo) || count($attachments) == 0) class="tab-pane" @else class="tab-pane active"
                 @endif id="all_attachments">

                <table class="table table-hover" id="customers-table">
                    <thead>
                    <tr class="active">
                        <th class="col-sm-1">#</th>
                        <th>{!! trans('common.title') !!}</th>
                        <th>{!! trans('common.file_extension') !!}</th>
                        <th>{!! trans('common.action') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($attachments  as $key =>$attach)
                            <tr>
                                <td><a href="{{ url('attachments/'.$attach->id) }}" data-toggle="tooltip" data-placement="top" data-title="{{ trans('common.download') }}">{!! $key+1 !!}</a></td>
                                <td><a href="{{ url('attachments/'.$attach->id) }}" data-toggle="tooltip" data-placement="top" data-title="{{ trans('common.download') }}">{{ $attach->title }}</a></td>
                                <td>{{ array_reverse(explode('.', $attach->path))[0] }}</td>

                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['attachments.destroy', $attach->id], 'class' => 'delete-form']) !!}
                                    <a href="{{ url('attachments/'.$attach->id) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" data-title="{{ trans('common.download') }}"><i class="fa fa-download"></i></a>
                                    <!-- {!! btn_edit("attachments/$attach->id/edit") !!} -->
                                    {!! btn_delete_submit() !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="{{ ((count($errors) > 0) || isset($attachInfo) || count($attachments) == 0)? 'tab-pane active' : 'tab-pane' }}" id="manage_attachment">
                @if( !isset($attachInfo) )
                        {!! Form::open(['url' => "attachments",'id'=>'attachment','class'=>'', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                        @include('attachment._form',['submit_button' => trans('common.submit')])

                    {!! Form::close() !!}
                @else
                    {!! Form::model($attachInfo,['method' =>'PUT', 'url' => ["attachments",$attachInfo->id],'id'=>'attach','class'=>'', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes', 'files' => true]) !!}

                    @include('attachment._form',['submit_button' => trans('common.update')])

                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

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
    </script>
                    
@endsection