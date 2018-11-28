@extends('app')

@section('main-content')
<?php //print_r($errors->hasAnyAny()); die();?>
    <!-- <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script> -->
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li class="{{ ((count($errors) > 0) || isset($userInfo) || count($customers) == 0) ? '' : 'active' }}"><a href="#customers"
                                                                                                  data-toggle="tab">{{ trans('common.customers') }}</a></li>
            <li class="{{ ((count($errors) > 0) || isset($userInfo) || count($customers) == 0) ? 'active' : '' }}"><a href="#manage_customers"
                                                                                                      data-toggle="tab">{{ $add_edit_title }}</a>
            </li>
        </ul>
        <div class="tab-content no-padding">
            <!-- ************** general *************-->
            <div @if ((count($errors) > 0) || isset($userInfo) || count($customers) == 0) class="tab-pane" @else class="tab-pane active"
                 @endif id="customers">

                <table class="table table-hover" id="customers-table">
                    <thead>
                    <tr class="active">
                        <th class="col-sm-1">#</th>
                        <th>{!! trans('common.name') !!}</th>
                        <th>{!! trans('common.email') !!}</th>
                        <th>{!! trans('common.status') !!}</th>
                        <th>{!! trans('common.package') !!}</th>
                        <th>{!! trans('common.remaining_email') !!}</th>
                        <th>{!! trans('common.action') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $key =>$customer)
                            <?php $package = \App\Models\Package\Package::find($customer->package_id); ?>
                            <tr>
                                <td><a href="{{ url('customers/'.$customer->id) }}" data-toggle='tooltip' data-placement='top'
                                       title="{{ trans('common.customer'). ' ' .trans('common.detail') }}">{!! $key+1 !!}</a></td>
                                <td><a href="{{ url('customers/'.$customer->id) }}" data-toggle='tooltip' data-placement='top'
                                       title="{{ trans('common.customer'). ' ' .trans('common.detail') }}">{!! $customer->name !!}</a></td>
                                <td>{{ $customer->email }}</td>
                                <td><span @if($customer->status == 'Active') class="label label-success"
                                          @elseif($customer->status == 'Banned') class="label label-danger"
                                            @endif> <a style="color: white;" href="{{ url("users/change_status/$customer->id") }}">{{ $customer->status }}</a> </span>
                                </td>
                                <td>
                                    @if($package)
                                        <span class="label label-default">{{ $package->name }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($package)
                                        <span class="label label-default">{{ $customer->email_limit }}</span>
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['customers.destroy', $customer->id], 'class' => 'delete-form']) !!}
                                    @if($customer->status == 'Active')
                                        {!! btn_banned(url("customers/change_status/$customer->id")) !!}
                                    @elseif($customer->status == 'Banned')
                                        {!! btn_active(url("customers/change_status/$customer->id")) !!}
                                    @endif
                                    {!! btn_show("customers/$customer->id") !!}
                                    {!! btn_edit("customers/$customer->id/edit") !!}
                                    @if($customer->role != 'superadmin')
                                        {!! btn_delete_submit() !!}
                                    @endif
                                    {!! Form::close() !!}
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="{{ ((count($errors) > 0) || isset($userInfo) || count($customers) == 0)? 'tab-pane active' : 'tab-pane' }}" id="manage_customers">
                @if( !isset($userInfo) )
                        {!! Form::open(['url' => "customers",'id'=>'customer','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                        @include('customers._form',['submit_button' => trans('common.submit')])

                    {!! Form::close() !!}
                @else
                    {!! Form::model($userInfo,['method' =>'PUT', 'url' => ["customers",$userInfo->id],'id'=>'users','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes', 'files' => true]) !!}

                    @include('customers._form',['submit_button' => trans('common.update')])

                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var export_filename = '{{ request()->segment(1) }}';

            $('#customers-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Copy',
                        extend: 'copy',
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    }, {
                        text: 'CSV',
                        extend: 'csvHtml5',
                        title: export_filename,
                        extension: '.csv',
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    }, {
                        text: 'XLS',
                        extend: 'excelHtml5',
                        title: export_filename,
                        extension: '.xls',
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    }, {
                        text: 'PDF',
                        extend: 'pdf',
                        title: export_filename,
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    }, {
                        text: 'Print',
                        extend: 'print',
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    }
                ]
            });
        });   
    </script>    

@endsection