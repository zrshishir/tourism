@extends('app')

@section('main-content')
    <style>
        .badge-success {
            background-color: #398439;
        }

        .badge-danger {
            background-color: #d43f3a;
        }
    </style>

    <div class="box box-default">
        <!-- Tabs within a box -->
        <div class="box-header with-border">
            <h3 class="box-title pull-left">{{ $title }}


            </h3>
            <div class="pull-right">
                <a href="{{ url('clearHistory') }}"
                   class="btn btn-xs bg-purple pull-right delete-swl">{{ trans('common.clear').' '. trans('common.history') }}</a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover" id="dataTables">
                <thead>
                <tr class="active">
                    <th class="col-sm-1">#</th>
                    @if(isset($histories))
                        <th>{!! trans('common.sender') !!}</th>
                        <th>{!! trans('common.email-list') !!}</th>
                        <th>{!! trans('common.email') . ' ' . trans('common.opens') !!}</th>
                        <th>{!! trans('common.click_rate') !!}</th>
                        <th>{!! trans('common.template') !!}</th>
                        <th>{!! trans('common.subject') !!}</th>
                        <th>{!! trans('common.time') !!}</th>
                        <!-- <th>{!! trans('common.action') !!}</th> -->
                    @endif
                </tr>
                </thead>
                <tbody>
                @if(isset($histories))
                    @foreach($histories as $historyId => $emailHistory)
                        <tr>
                            <td>{!! $historyId+1 !!}</td>
                            <td>{{ $emailHistory['sender'] }}</td>
                            <td><a href="{{ url('show/'. $historyId) }}" data-toggle='tooltip'
                                   data-placement='top'
                                   title='{{ trans('common.opens'). ' ' .trans('common.detail') }}'>{{ $emailHistory['totalEmail']. ' email(s)' }}</a>
                            </td>
                            <td>
                                    <span class="badge badge-success" data-toggle='tooltip' data-placement='top'
                                          title='{{ trans('common.seen') }}'>{{ $emailHistory['emailOpen'] }}</span>
                                <span class="badge badge-danger" data-toggle='tooltip' data-placement='top'
                                      title='{{ trans('common.unseen') }}'>{{ $emailHistory['totalEmail'] - $emailHistory['emailOpen'] }}</span>
                            </td>
                            <td>
                                <a href="{{ url('show/'. $historyId) }}"><span
                                            class="badge badge-success" data-toggle='tooltip' data-placement='top'
                                            title='{{ trans('common.click_rate') }}'>{{ ($emailHistory['emailOpen'] == 0 ? 0 : ($emailHistory['totalEmail'] == 0 ? 0 :round(($emailHistory['emailOpen']/$emailHistory['totalEmail']), 2)*100).'%') }}</span></a>
                            </td>
                            <td>
                                {{ $emailHistory['template'] }}
                            </td>
                            <td>{{ $emailHistory['subject'] }}</td>
                            <td>{{ $emailHistory['time'] }}</td>
                            <!-- <td id='date_{{ $historyId}}'></td> -->
                            
                                                      
                            <!-- <td>
                                <a href="#" data-toggle="modal"
                                   data-target="#history_detail_{{ $historyId }}" class='btn btn-info btn-xs'
                                   data-toggle='tooltip' data-placement='top'
                                   title='{{ trans('common.detail') }}'><i
                                            class='fa fa-list-alt'></i></a>
                            </td> -->
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>


 
@endsection