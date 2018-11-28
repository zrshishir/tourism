@extends('app')

@section('main-content')

    <style>
        /*.note-group-select-from-files {*/
        /*display: none;*/
        /*}*/
    </style>
    <script type="text/javascript">
        //        $(document).ready(function () {
        //            $("select").imagepicker();
        //        });
    </script>

    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li @if ((count($errors) > 0) || isset($template) || count($templates) == 0) class="" @else class="active" @endif >
                <a href="#allTemplate" data-toggle="tab">
                    {{ trans('common.all') . ' '. trans('common.template')}}</a>
            </li>
            <li @if ((count($errors) > 0) || isset($template) || count($templates) == 0) class="active" @else class="" @endif ><a
                        href="#template"
                        data-toggle="tab">{{ $title }}</a>
            </li>
        </ul>
        <div class="tab-content no-padding">
            <!-- ************** general *************-->
            <div @if ((count($errors) > 0) || isset($template) || count($templates) == 0) class="tab-pane" @else class="tab-pane active"
                 @endif id="allTemplate">

                <table class="table table-hover" id="dataTables">
                    <thead>
                        <tr class="active">
                            <th class="col-sm-1">#</th>
                            <th>{!! trans('common.name') !!}</th>
                            <th>{!! trans('common.action') !!}</th>
                        </tr>
                    </thead>
                    <tbody>

                    @if(count($templates ) > 0)
                        @foreach($templates  as $key =>$list)
                            <tr>
                                <td>{!! $key+1 !!}</td>
                                <td>
                                    <a href="#" data-toggle="modal"
                                       data-target="#template_detail_{{ $list->id }}"
                                       data-toggle='tooltip' data-placement='top'
                                       title='{{ trans('common.detail') }}'>{{ $list->name }}
                                    </a>
                                </td>

                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['template.destroy', $list->id], 'class' => 'delete-form']) !!}
                                    <a href="#" data-toggle="modal"
                                       data-target="#template_detail_{{ $list->id }}" class='btn btn-info btn-xs'
                                       data-toggle='tooltip' data-placement='top'
                                       title='{{ trans('common.detail') }}'><i
                                                class='fa fa-list-alt'></i></a>
                                    {!! btn_edit("template/$list->id/edit") !!}
                                    {!! btn_delete_submit() !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div @if ((count($errors) > 0) || isset($template) || count($templates) == 0) class="tab-pane active" @else class="tab-pane"
                 @endif id="template">

                @if( !isset($template) )
                    {!! Form::open(['url' => "template",'id'=>'template', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                    @include('template._form',['submit_button' => 'Submit'])

                    {!! Form::close() !!}
                @else
                    {!! Form::model($template,['method' =>'PUT', 'url' => ["template",$template->id],'id'=>'template', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes', 'files' => true]) !!}

                    @include('template._form',['submit_button' => 'Update'])

                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="upload_template" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="myModalLabel">{{ trans('common.upload'). ' ' .trans('common.template') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="callout callout-info">
                        Please see <a class="text-warning" href="/customer/assets/files/example-template.zip" data-original-title=""
                                      title="">this example archive</a> in order to understand how you should format
                        your uploaded archive! Also, please note we only accept zip files.
                    </div>
                    {!! Form::open(['url' => "upload_template", 'id'=>'upload_template_form', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}
                        <div class="form-group">
                            <label for="CustomerEmailTemplate_archive" class="required">Archive file <span
                                        class="required">*</span></label>
                            <input class="form-control" placeholder="Archive file"
                                    name="upload_template" id="CustomerEmailTemplate_archive"
                                    type="file">
                            <p class="text-danger" id="upload_template_error"></p>
                        </div>
                    <div class="modal-footer">
                        {!! Form::submit(trans("common.upload") ,['onclick' => 'submit_form(event)', 'class' => 'pull-right btn btn-sm btn-primary'])!!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @foreach($templates as $list)
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

    <div class="modal fade" id="imageUploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"
                        id="myModalLabel">{{ trans('common.media'). ' ' . trans('common.import')}}

                        <button class="btn btn-xs btn-success pull-right"
                                onclick="useMedia()">{{ trans('common.use') }}</button>
                    </h4>

                </div>
                <div class="modal-body">
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs">
                            <li @if ((count($errors) > 0)) class="" @else class="active" @endif >
                                <a href="#allMedia" data-toggle="tab" id="allMediaDiv">
                                    {{ trans('common.all') . ' '. trans('common.media')}}</a>
                            </li>
                            <li @if ((count($errors) > 0)) class="active" @else class="" @endif ><a
                                        href="#uploadImage" id="media_upload"
                                        data-toggle="tab">{{ trans('common.upload'). ' ' . trans('common.image') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- ************** general ************** -->
                            <div @if ((count($errors) > 0)) class="tab-pane" @else class="tab-pane active"
                                 @endif id="allMedia">
                                <div class="row">
                                    <div class="col-md-12">
                                        <select multiple="multiple" class="image-picker show-html" id="select_media">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div @if ((count($errors) > 0)) class="tab-pane active" @else class="tab-pane"
                                 @endif id="uploadImage">
                                {!! Form::open(['url' => "media",'id'=>'media_modal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                                <div class="form-group required">
                                    {!! Form::label('title',trans('common.title')) !!}
                                    {!! Form::text('title',null, ['id' => 'title', 'class' =>'form-control']) !!}
                                    <p class="text-danger" id="title_error">{{$errors->first('title')}}</p>
                                </div>

                                <div class="form-group required">
                                    {!! Form::label('media',trans('common.media')) !!}
                                    <div class="fileinput fileinput-new" data-provides="fileinput"
                                         style="display:block">
                                        <div class="fileinput-new thumbnail" style="width: 210px;">
                                            @if (isset($media) && ($media->path != ''))
                                                {!! Html::image('upload/'.$media->path) !!}
                                            @else
                                                <img src="http://placehold.it/350x260"
                                                     alt="Please Connect Your Internet">
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                             style="width: 210px;"></div>
                                        <div>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">
                                                    <input type="file" name="media" value="upload"
                                                           data-buttonText="<?= trans('choose_file') ?>"
                                                           id="myImg"/>
                                                    <span class="fileinput-exists">{!! trans('common.change') !!}</span>
                                                </span>
                                                <a href="#" class="btn btn-default fileinput-exists"
                                                   data-dismiss="fileinput"
                                                   id="image_remove">{!! trans('common.remove') !!}</a>
                                            </span>
                                        </div>
                                        <p class="text-danger" id="media_error">{{$errors->first('media')}}</p>
                                    </div>

                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Upload & Import',['class' => 'btn btn-sm btn-primary submit_btn'])!!}
                                    {!! Form::submit('Upload',['class' => 'btn btn-sm btn-primary submit_btn'])!!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{!! trans('common.close') !!}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorlogshow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Error Logs</h4>

                </div>
                <div class="modal-body pre-scrollable">
                    <div class="nav-tabs-custom" id="errorlogbody">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{!! trans('common.close') !!}</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $('#htmlvalidation').on('click', function(e){
               $('button.active[data-event="codeview"]').click();
            });
        });
        function submit_form(e) {
                var formData = new FormData($('#upload_template_form')[0]);
                var url = "{{ url('upload_template') }}";

                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        swal({
                                    title: "Uploaded!",
                                    text: data,
                                    type: "success",
                                    confirmButtonText: "OK",
                                },
                                function (isConfirm) {
                                    window.location.href = '{{ url('template') }}';
                                });
                    },
                    error: function (errors) {
                        $.each(errors.responseJSON, function (key, error) {
                            $('#' + key + '_error').text(error[0]);
                        });
                    }
                });
            
        }


        function loadModal() {
            console.log('yes it is working');
            $('#imageUploadModal').modal('show');
            $('#allMediaDiv').click();

            clearUploadImage();

            var img_base_path = '{{ asset("upload") }}';
            $.ajax({
                url: "{{ url('loadMedia') }}",
                method: 'post',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    $('#select_media').empty();

                    for (var i = 0; i < data.length; i++) {
                        $('#select_media').append('<option data-img-src="' + data[i].value + '" value=" ' + data[i].id + '">' + data[i].title + '</option>');
                    }
                    $("select").imagepicker();

                    $('#imageUploadModal').modal('show');
                }
            });
        }

        function useMedia() {
            $('#imageUploadModal').modal('hide');
            $('#template_body').summernote('focus');
            $('#select_media :selected').each(function (i, selected) {
                $('#template_body').summernote('editor.insertImage', $(selected).attr('data-img-src'));
            });
            $('#select_media').val('');

        }

        $('.submit_btn').click(function (e) {
            e.preventDefault();
            var formData = new FormData($('#media_modal')[0]);
            var that = this;
            $.ajax({
                url: "{{ url('media') }}",
                method: 'post',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    var img_base_path = '{{ asset('upload') }}';
                    if (data.success) {
                        if ($(that).attr('value') == 'Upload & Import') {
                            $('#imageUploadModal').modal('hide');
                            $('#allMediaDiv').click();
                            $('#template_body').summernote('focus');
                            $('#template_body').summernote('editor.insertImage', img_base_path + '/' + data.media_info.path);
                        } else {
                            $('#select_media').append('<option data-img-src="' + img_base_path + '/' + data.media_info.path + '" value=" ' + data.media_info.id + '">' + data.media_info.title + '</option>');

                            $("select").imagepicker();

                            $('#allMediaDiv').click();
                        }


                    } else {
                        swal("Something Wrong!!!");
                    }
                },
                error: function (errors) {
                    $.each(errors.responseJSON, function (key, error) {
                        $('#' + key + '_error').text(error[0]);
                    });
                }
            });
        });

        $(function () {
            $('#media_upload').click(function () {
                clearUploadImage();
            });

            $('#use_btn').click(function () {
                $('#select_media :selected').each(function (i, selected) {
                    alert($(selected).attr('data-img-src'));
                });
            });
        });

        function clearUploadImage() {
            $('#title_error').text('');
            $('#media_error').text('');

            $('#title').val('');
            $('#media').val('');
            $('#image_remove').click();
        }
    </script>

@endsection
