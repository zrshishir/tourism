@extends('app')

@section('main-content')

    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li @if ((count($errors) > 0) || isset($medium) || count($medias) == 0) class="" @else class="active" @endif ><a href="#allMedia"
                                                                                                   data-toggle="tab">
                    {{ trans('common.all') . ' '. trans('common.media')}}</a></li>
{{--            @if(Auth::user()->role == 'superadmin' || (isset($medium) && ($medium->id == Auth::id())))--}}
                <li @if ((count($errors) > 0) || isset($medium) || count($medias) == 0) class="active" @else class="" @endif ><a
                            href="#media"
                            data-toggle="tab">{{ $title }}</a>
                </li>
            {{--@endif--}}
        </ul>
        <div class="tab-content no-padding">
            <!-- ************** general *************-->
            <div @if ((count($errors) > 0) || isset($medium) || count($medias) == 0) class="tab-pane" @else class="tab-pane active"
                 @endif id="allMedia">

                <table class="table table-hover" id="dataTables">
                    <thead>
                    <tr class="active">
                        <th class="col-sm-1">#</th>
                        <th>{!! trans('common.title') !!}</th>
                        <th>{!! trans('common.media') !!}</th>
                        <th>{!! trans('common.action') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($medias ) > 0)
                        @foreach($medias  as $key =>$list)
                            <tr>
                                <td>{!! $key+1 !!}</td>
                                <td>{{ $list->title }}</td>
                                <td><img src="{{ asset('upload/'. $list->path) }}" style="height: 100px; width: 120px" class="img-responsive"></td>

                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['media.destroy', $list->id], 'class' => 'delete-form']) !!}
                                    {!! btn_edit("media/$list->id/edit") !!}
                                    {!! btn_delete_submit() !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div @if ((count($errors) > 0) || isset($medium) || count($medias) == 0) class="tab-pane active" @else class="tab-pane"
                 @endif id="media">

                @if( !isset($medium) )
                    {!! Form::open(['url' => "media",'id'=>'media', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                    @include('media._form',['submit_button' => 'Submit'])

                    {!! Form::close() !!}
                @else
                    {!! Form::model($medium,['method' =>'PUT', 'url' => ["media",$medium->id],'id'=>'media', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes', 'files' => true]) !!}

                    @include('media._form',['submit_button' => 'Update'])

                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
<script>
     $('input[type="file"]').change(function(){
           
           var iniFileSize = '{{ $iniFileSize }}';
           console.log(iniFileSize);
           var fileSize = (this.files[0].size/1024/1024);
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
                        $('#myImg').val("");
                        if(typeof href !== 'undefined'){
                            window.location.href = href;
                        }
                    }
                });
           }

        });
</script>
@endsection