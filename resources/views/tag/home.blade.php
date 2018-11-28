@extends('app')

@section('main-content')

    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li @if ((count($errors) > 0) || isset($tag) || count($tags) == 0) class="" @else class="active" @endif ><a href="#allCategory"
                                                                                                   data-toggle="tab">
                    {{ trans('common.all') . ' '. trans('common.tag')}}</a></li>
{{--            @if(Auth::user()->role == 'superadmin' || (isset($tag) && ($tag->id == Auth::id())))--}}
                <li @if ((count($errors) > 0) || isset($tag) || count($tags) == 0) class="active" @else class="" @endif ><a
                            href="#tag"
                            data-toggle="tab">{{ $name }}</a>
                </li>
            {{--@endif--}}
        </ul>
        <div class="tab-content no-padding">
            <!-- ************** general *************-->
            <div @if ((count($errors) > 0) || isset($tag) || count($tags) == 0) class="tab-pane" @else class="tab-pane active"
                 @endif id="allMedia">

                <table class="table table-hover" id="dataTables">
                    <thead>
                    <tr class="active">
                        <th class="col-sm-1">#</th>
                       
                        <th>{!! trans('common.tags') !!}</th>
                        <th>{!! trans('common.action') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($tags ) > 0)
                        @foreach($tags  as $key =>$list)
                            <tr>
                                <td>{!! $key+1 !!}</td>
                                <td> {{ $list->name }}</td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['tag.destroy', $list->id], 'class' => 'delete-form']) !!}
                                    {!! btn_edit("tag/$list->id/edit") !!}
                                    {!! btn_delete_submit() !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div @if ((count($errors) > 0) || isset($tag) || count($tags) == 0) class="tab-pane active" @else class="tab-pane"
                 @endif id="tag">

                @if( !isset($tag) )
                    {!! Form::open(['url' => "tag",'id'=>'tag', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                    @include('tag._form',['submit_button' => 'Submit'])

                    {!! Form::close() !!}
                @else
                    {!! Form::model($tag,['method' =>'PUT', 'url' => ["tag",$tag->id],'id'=>'tag', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes', 'files' => true]) !!}

                    @include('tag._form',['submit_button' => 'Update'])

                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
@endsection