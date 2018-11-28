@extends('app')

@section('main-content')
    <style type="text/css">
        .box {
            margin-top: 0px;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="row " style="margin-top: 20px">
                <div class="col-sm-3">
                    <ul class="nav nav-pills nav-stacked navbar-custom-nav">
                        <li class="active"><a href="#task_details" data-toggle="tab"
                                              aria-expanded="true">{{ trans('common.details') }}</a>
                        </li>
                        <li class=""><a href="#users" data-toggle="tab"
                                        aria-expanded="false">{{ trans('common.users') }} <strong
                                        class="pull-right">{{ count($users) }}</strong></a>
                        </li>
                        <li class=""><a href="#package" data-toggle="tab"
                                        aria-expanded="false">{{ trans('common.package') }}<strong
                                        class="pull-right">{{ count($purchaseHistories) }}</strong></a>
                        </li>
                        <li class=""><a href="#estimates" data-toggle="tab" aria-expanded="false">Estimates<strong
                                        class="pull-right"></strong></a>
                        </li>
                        <li class=""><a href="#payments" data-toggle="tab" aria-expanded="false">Payments<strong
                                        class="pull-right"></strong></a>
                        </li>
                        <li class=""><a href="#transaction" data-toggle="tab" aria-expanded="false">Transactions <strong
                                        class="pull-right"></strong></a>
                        </li>

                        <li class=""><a href="#projects" data-toggle="tab" aria-expanded="false">Projects<strong
                                        class="pull-right">2</strong></a></li>
                        <li class=""><a href="#ticket" data-toggle="tab" aria-expanded="false">Tickets<strong
                                        class="pull-right">1</strong></a>
                        </li>
                        <li class=""><a href="#bugs" data-toggle="tab" aria-expanded="false">Bugs<strong
                                        class="pull-right">1</strong></a></li>
                    </ul>
                </div>
                <div class="col-sm-9">
                    <div class="tab-content" style="border: 0;padding:0;">
                        <!-- Task Details tab Starts -->
                        <div class="tab-pane active" id="task_details" style="position: relative;">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <div class="pull-left">
                                        <strong> {{ $customer->name. ' - '. trans('common.details') }} </strong>
                                    </div>
                                    <div class="pull-right">
                                        <a href='{{ url("customers/$customer->id/edit") }}'
                                           class="btn-xs "><i class="fa fa-edit"></i> {{ trans('common.edit') }}</a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <!-- Details START -->
                                    <div class="col-md-6">
                                        <div class="group">
                                            <h4 class="subdiv text-muted">{{ trans('common.contact'). ' ' .trans('common.details') }}</h4>
                                            <div class="row inline-fields">
                                                <div class="col-md-4">{{ trans('common.name') }}</div>
                                                <div class="col-md-6">{{ $customer->name }}</div>
                                            </div>
                                            <div class="row inline-fields">
                                                <div class="col-md-4">{{ trans('common.contact'). ' ' .trans('common.person') }}</div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row inline-fields">
                                                <div class="col-md-4">{{ trans('common.email') }}</div>
                                                <div class="col-md-6">{{ $customer->email }}</div>
                                            </div>
                                        </div>

                                        <div class="row inline-fields">
                                            <div class="col-md-4">{{ trans('common.city') }}</div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="row inline-fields">
                                            <div class="col-md-4">{{ trans('common.country') }}</div>
                                            <div class="col-md-6 text-success"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-lg">
                                        <div class="group">
                                            <div class="row" style="margin-top: 5px">
                                                <div class="rec-pay col-md-12">
                                                    <h4 class="subdiv text-muted">{{ trans('common.email_remaining') }}</h4>
                                                    <h3 class="amount text-danger cursor-pointer"><strong>
                                                            {{ $customer->email_limit }} </strong></h3>
                                                    <div class="row inline-fields">
                                                        <div class="col-md-4">{{ trans('common.address') }}</div>
                                                        <div class="col-md-6"></div>
                                                    </div>
                                                    <div class="row inline-fields">
                                                        <div class="col-md-4">{{ trans('common.phone') }}</div>
                                                        <div class="col-md-6"><a href=""></a></div>
                                                    </div>
                                                    <div class="row inline-fields">
                                                        <div class="col-md-4">{{ trans('common.website') }}</div>
                                                        <div class="col-md-6"><a href="" class="text-info"
                                                                                 target="_blank"></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center block mt">
                                    <div style="display: inline-block">

                                        <div id="easypie3" data-percent="{{ $sending_per }}" class="easypie-chart">
                                            <span class="h2">{{ $sending_per. '%' }}</span>
                                            <div class="easypie-text">{{ trans('common.email'). ' ' .trans('common.sending') }}</div>

                                        </div>
                                    </div>
                                </div>


                            <div class="panel-footer">
                        <span>Package cost: <strong class="label label-primary">
                                $ 0.00                            </strong></span>
                                <span class="text-danger pull-right">
                           Remaining day                            :<strong class="label label-danger"> $ 0.00</strong>
                        </span>
                            </div>
                        </div>
                    </div>
                    <!--            *************** contact tab start ************-->
                    <div class="tab-pane " id="users" style="position: relative;">
                        <section class="box box-default">
                            <div class="box-header with-border">
                                <div class="pull-left">
                                    <strong>{{ trans('common.users') }}</strong>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('users') }}"
                                       class="btn-sm pull-right">{{ trans('common.new'). ' ' .trans('common.user') }}</a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover" id="dataTables">
                                    <thead>
                                    <tr class="active">
                                        <th class="col-sm-1">#</th>
                                        <th>{!! trans('common.name') !!}</th>
                                        <th>{!! trans('common.email') !!}</th>
                                        <th>{!! trans('common.status') !!}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td>{!! $key+1 !!}</td>
                                            <td><i class="fa fa-{{ $user->platform }}"></i> {!! $user->name !!} </td>
                                            <td>{{ $user->email }}</td>
                                            <td><span @if($user->status == 'Active') class="label label-success"
                                                      @elseif($user->status == 'Banned') class="label label-danger"
                                                        @endif> <a style="color: white;"
                                                                   href="{{ url("users/change_status/$user->id") }}">{{ $user->status }}</a> </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>

                    {{--package start--}}
                    <div class="tab-pane " id="package" style="position: relative;">
                        <section class="box box-default">
                            <div class="box-header with-border">
                                <div class="pull-left">
                                    <strong>{{ trans('common.package') . ' ' .trans('common.report') }}</strong>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover" id="dataTables">
                                    <thead>
                                    <tr class="active">
                                        <th class="col-sm-1">#</th>
                                        <th>{!! trans('common.name') !!}</th>
                                        <th>{!! trans('common.validity') !!}</th>
                                        <th>{!! trans('common.limit') !!}</th>
                                        <th>{!! trans('common.price') !!}</th>
                                        <th>{!! trans('common.activated_at') !!}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($purchaseHistories as $key => $purchaseHistory)
                                        <tr>
                                            <td>{!! $key+1 !!}</td>
                                            <td>
                                                <span class="label label-default">{{ $purchaseHistory->package_name }}</span>
                                            </td>
                                            <td>
                                                <span class="label label-default">{{ $purchaseHistory->package_validity. ' days' }}</span>
                                            </td>
                                            <td>
                                                <span class="label label-default">{{ $purchaseHistory->package_limit }}</span>
                                            </td>
                                            <td>{{ '$'.$purchaseHistory->package_price }}</td>
                                            <td><span class="label label-default"
                                                      id='date_{{ $purchaseHistory->id }}'></span></td>
                                        </tr>
                                        <script type="text/javascript">
                                            $("#date_" + '{{ $purchaseHistory->id}}').text(formatAMPM("{{ date('n/j/Y h:i:s A', strtotime($purchaseHistory->created_at)) . ' UTC'}}"));
                                        </script>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

@endsection