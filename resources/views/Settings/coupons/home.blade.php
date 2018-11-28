@extends('app')

@section('main-content')
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li class="{{ ((count($errors) > 0) || isset($couponInfo)) ? '' : 'active' }}">
                <a href="#all_coupons" data-toggle="tab">{{ trans('common.all'). " ". trans('common.coupons') }}</a></li>
            <li class="{{ ((count($errors) > 0) || isset($couponInfo)) ? 'active' : '' }}">
                <a href="#manage_coupon" data-toggle="tab">{{ $add_edit_coupon }}</a>
            </li>
        </ul>
        <div class="tab-content no-padding">
            <!-- ************** general *************-->
            <div @if ((count($errors) > 0) || isset($couponInfo)) class="tab-pane" @else class="tab-pane active"
                 @endif id="all_coupons">

                <table class="table table-hover" id="customers-table">
                    <thead>
                    <tr class="active">
                        <th class="col-sm-1">#</th>
                        <th>{!! trans('common.name') !!}</th>
                        <th>{!! trans('common.coupon'). ' ' .trans('common.code') !!}</th>
                        <th>{!! trans('common.package_list') !!}</th>
                        <th>{!! trans('common.discount_amount') !!}</th>
                        <th>{!! trans('common.amount_type') !!}</th>
                        <th>{!! trans('common.published') !!}</th>
                        <th>{!! trans('common.action') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($coupons  as $key =>$coupon)
                            <?php $package_list = []; 
                                foreach(json_decode($coupon->package_id) as $id) {
                                    $pack = \App\Models\Package\Package::find($id);
                                    if($pack) {
                                        $package_list[] = $pack->name;
                                    }
                                }
                            ?>
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $coupon->name }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td><span class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" data-title="{{ implode(', ', $package_list) }}"><i class="fa fa-list"></i></td>
                                <td>{{ $coupon->discount_amount }}</td>
                                <td>
                                    @if($coupon->amount_type == 'percentage_amount')
                                        {{ trans('common.percentage_amount') }}
                                    @elseif($coupon->amount_type == 'fixed_amount')
                                        {{ trans('common.fixed_amount') }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('coupons/changed_published/'.$coupon->id) }}" class="btn btn-primary btn-xs">
                                        @if($coupon->published == 'yes')
                                            {{ trans('common.yes') }}
                                        @elseif($coupon->published == 'no')
                                            {{ trans('common.no') }}
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['coupons.destroy', $coupon->id], 'class' => 'delete-form']) !!}
                                        {!! btn_edit("coupons/$coupon->id/edit") !!}
                                        {!! btn_delete_submit() !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="{{ ((count($errors) > 0) || isset($couponInfo))? 'tab-pane active' : 'tab-pane' }}" id="manage_coupon">
                @if( !isset($couponInfo) )
                        {!! Form::open(['url' => "coupons",'class'=>'', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                        @include('Settings.coupons.form',['submit_button' => trans('common.submit')])

                    {!! Form::close() !!}
                @else
                    {!! Form::model($couponInfo,['method' =>'PUT', 'url' => ["coupons",$couponInfo->id],'class'=>'', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes', 'files' => true]) !!}

                    @include('Settings.coupons.form',['submit_button' => trans('common.update')])

                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
                    
@endsection