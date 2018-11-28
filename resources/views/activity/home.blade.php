@extends('app')

@section('main-content')

    <div class="box box-default" >
        <div class="box-header with-border">
            <h3 class="box-title pull-left">{!! trans('common.all_activities') !!}</h3>
            @if(Auth::user()->role == 'superadmin')
                <a href="{{ url('activities/clear') }}" class="btn btn-xs bg-purple pull-right delete-swl">{{ trans('common.clear').' '. trans('common.Activities') }}</a>
            @endif
        </div>
        <div class="box-body">
                <table class="table table-hover" id="activity-dataTables">
                    <thead>
                    <tr class="active">
                        <th> {!! trans('common.user').' '.trans('common.name') !!}</th>
                        <th> {!! trans('common.user').' '.trans('common.email') !!}</th>
                        <th> {!! trans('common.ip') !!}</th>
                        <th> {!! trans('common.message') !!}</th>
                        <th> {!! trans('common.log_time') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activities as $activity)
                        <tr>
                            <td>{{ $activity->user->name }}</td>
                            <td>{{ $activity->user->email }}</td>
                            <td>{{ $activity->ip }}</td>
                            <td>{{ $activity->message }}</td>
                            <td id='date_{{ $activity->id }}'></td> 
                        </tr>
        <script type="text/javascript">                
                $("#date_" + '{{ $activity->id}}' ).text(formatAMPM("{{ date('n/j/Y h:i:s A', strtotime($activity->created_at)) . ' UTC'}}"));
        </script>
                    @endforeach
                    </tbody>
                </table>
    </div>
    </div>

@endsection