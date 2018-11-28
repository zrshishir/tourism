@extends('app')

@section('main-content')
    <style>
        .note-group-select-from-files {
            display: none;
        }
    </style>

    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li @if ((count($errors) > 0) || isset($package) || count($packages) == 0) class="" @else class="active" @endif >
                <a href="#allPackage" data-toggle="tab">
                    {{ trans('common.all') . ' '. trans('common.package')}}</a>
            </li>
            <li @if ((count($errors) > 0) || isset($package) || count($packages) == 0) class="active" @else class="" @endif ><a
                        href="#package"
                        data-toggle="tab">{{ $title }}</a>
            </li>
        </ul>
        <div class="tab-content no-padding">
            <!-- ************** general *************-->
            <div @if ((count($errors) > 0) || isset($package) || count($packages) == 0) class="tab-pane" @else class="tab-pane active"
                 @endif id="allPackage">

                <table class="table table-hover" id="dataTables">
                    <thead>
                    <tr class="active">
                        <th class="col-sm-1">#</th>
                        <th>{!! trans('common.name') !!}</th>
                        <th>{!! trans('common.action') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($packages ) > 0)
                        @foreach($packages  as $key =>$list)
                            <tr>
                                <td>{!! $key+1 !!}</td>
                                <td>
                                    <a href="#" data-toggle="modal"
                                       data-target="#package_detail_{{ $list->id }}"
                                       data-toggle='tooltip' data-placement='top'
                                       title='{{ trans('common.detail') }}'>{{ $list->name }}
                                    </a>
                                </td>

                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['package.destroy', $list->id], 'class' => 'delete-form']) !!}
                                    <a href="#" data-toggle="modal"
                                       data-target="#package_detail_{{ $list->id }}" class='btn btn-info btn-xs'
                                       data-toggle='tooltip' data-placement='top'
                                       title='{{ trans('common.detail') }}'><i
                                                class='fa fa-list-alt'></i></a>
                                    {!! btn_edit("package/$list->id/edit") !!}
                                    {!! btn_delete_submit() !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div @if ((count($errors) > 0) || isset($package) || count($packages) == 0) class="tab-pane active" @else class="tab-pane"
                 @endif id="package">

                @if( !isset($package) )
                    {!! Form::open(['url' => "package",'id'=>'package', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                    @include('package._form',['submit_button' => 'Submit'])

                    {!! Form::close() !!}
                @else
                    {!! Form::model($package,['method' =>'PUT', 'url' => ["package",$package->id],'id'=>'package', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes', 'files' => true]) !!}

                    @include('package._form',['submit_button' => 'Update'])

                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

    @foreach($packages as $list)

        <div class="modal fade" id="package_detail_{{ $list->id }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="myModalLabel">{{ $list->name . ' ' . trans('common.package') }}</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover">
                            <thead>
                                <tr class="active">
                                    <th>{!! trans('common.name') !!}</th>
                                    <th>{!! trans('common.action') !!}</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>{{ trans('common.name') }}</td>
                                    <td> {!! $list->name !!} </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('common.validity') }}</td>
                                    <td>  {!! $list->validity !!} </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('common.limit') }}</td>
                                    <td> {!! $list->limit !!} </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('common.price') }}</td>
                                    <td> {!! $list->price !!} </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <script>
        var count_row = 0;

        $(document).ready(function () {
            $('#summernote').summernote({
                height: 300
            });
        });



    </script>

@endsection