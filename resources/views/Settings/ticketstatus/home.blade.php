@extends('app')

@section('main-content')

    <div class="box box-default">
        <!-- Tabs within a box -->
        <div class="box-header with-border">
            <h3 class="box-title pull-left">{{ trans('common.ticketstatus') }}</h3>
        </div>

        <!-- ************** general *************-->

        {!! Form::open(['url' => isset($groupInfo) ? 'customer-groups/group-update' : 'customer-groups/group-save', 'id'=>'status','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

        <table class="table table-hover">
            <thead>
            <tr class="active">
                <th class="col-sm-1">#</th>
                <th>{!! trans('common.status') !!}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($TicketStatus as $key => $Status)
                <tr>
                    <td><a href="{{ url('#') }}">{!! $key+1 !!}</a></td>
                    <td>
                        @if(isset($groupInfo) && ($Status->id == $groupInfo->id))
                            <div class="col-md-7">
                                <input type="hidden" name="group_id" value="{{ $groupInfo->id }}">
                                <input name="name" class="form-control" value="{{ $groupInfo->status }}" required>
                                <p class="text-danger">{{ $errors->first('status') }}</p>
                            </div>
                        @else
                            <a href="#">{{ $Status->status }}</a>
                        @endif
                    </td>
                    
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! Form::close() !!}
    </div>

    <script>
        $(function () {
//            $('#dataTables-groups').DataTable();

            $('.status-edit').editable({
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