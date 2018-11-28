@extends('app')

@section('main-content')

    <div class="box box-default">
        <!-- Tabs within a box -->
        <div class="box-header with-border">
            <h3 class="box-title pull-left">{{ trans('common.customer') .' ' . trans('common.groups') }}</h3>
        </div>

        <!-- ************** general *************-->

        {!! Form::open(['url' => isset($groupInfo) ? 'customer-groups/group-update' : 'customer-groups/group-save', 'id'=>'customer_group','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

        <table class="table table-hover">
            <thead>
            <tr class="active">
                <th class="col-sm-1">#</th>
                <th>{!! trans('common.name') !!}</th>
                <th>{!! trans('common.action') !!}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customerGroups as $key => $customerGroup)
                <tr>
                    <td><a href="{{ url('') }}">{!! $key+1 !!}</a></td>
                    <td>
                        @if(isset($groupInfo) && ($customerGroup->id == $groupInfo->id))
                            <div class="col-md-7">
                                <input type="hidden" name="group_id" value="{{ $groupInfo->id }}">
                                <input name="name" class="form-control" value="{{ $groupInfo->name }}" required>
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                        @else
                            <a href="#">{{ $customerGroup->name }}</a>
                        @endif
                    </td>
                    <td>
                        {{--                            {!! Form::open(['method' => 'DELETE', 'route' => ['customers.group-destroy', $customerGroup->id], 'class' => 'delete-form']) !!}--}}
                        @if(isset($groupInfo) && ($customerGroup->id == $groupInfo->id))
                            <button type="submit" class="btn btn-xs bg-purple"><i
                                        class="fa fa-check"></i></button>
                            {!! '<a href="' . url('customer-groups/') . '" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="' . trans('common.cancel') . '"><i class="fa fa-times"></i></a>'  !!}
                        @else
                            {!! btn_edit("customer-groups/group-edit/$customerGroup->id") !!}
                            {!! '<a href="' . url('customer-groups/group-destroy/'.$customerGroup->id) . '" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" data-original-title="' . trans('common.delete') . '"><i class="fa fa-trash"></i></a>'  !!}
                        @endif
                        {{--                                {!! btn_delete_submit() !!}--}}
                        {{--                            {!! Form::close() !!}--}}
                    </td>
                </tr>
            @endforeach
            @if(! isset($groupInfo))
                <tr>
                    <td></td>
                    <td>
                        <div class="col-md-7">
                            <input name="name" class="form-control" name="{{ old('name') }}"
                                   placeholder="{{ trans('common.new').' '.trans('common.customer'). ' ' .trans('common.group'). ' '.trans('common.name') }}">
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-xs bg-purple"><i
                                    class="fa fa-check"></i></button>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>

        {!! Form::close() !!}
    </div>

    <script>
        $(function () {
//            $('#dataTables-groups').DataTable();

            $('.group-name-edit').editable({
                params: function (params) {
                    params._token = '{{ csrf_token() }}';
                    return params;
                },
                validate: function (value) {
                    if ($.trim(value) == '') {
                        return 'This field is required';
                    }
                },
                ajaxOptions: {
                    success: function (data) {
                        swal({
                                    title: data.title,
                                    text: data.msg,
                                },
                                function () {
//                                    console.log(data);
                                    window.location.reload();
                                });
                    }
                }
            });
        });
    </script>

@endsection