@extends('app')


@section('main-content')

<section id="pricing">
    <div class="">
        <div class="section-header">
            <h2 class="section-title text-center wow fadeInDown">{{ trans('common.pricing_table') }}</h2>
            <br>
        </div>
        {!! Form::open(['url' => "pricing", 'class' => "form-horizontal", 'id'=>'package', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}
            @if(Auth::check() && (Auth::id() == superadmin('id')))
                <div class="form-group required">
                    {!! Form::label('customer_id', trans('common.select'). ' ' .trans('common.customer'),['class'=> 'col-lg-4 control-label']) !!}
                    <div class="col-lg-5">
                        {!! Form::select('customer_id', $customers, null, [ 'id' => 'customer_id', 'required' => 'true', 'class'=>'form-control', 'placeholder' => trans('common.select'). ' ' .trans('common.customer')])!!}
                        <p class="text-danger">{{$errors->first('customer_id')}}</p>
                    </div>
                </div>
            @endif
            <div class="row">
                @foreach($packages as $key => $package)
                <div class="col-sm-6 col-md-4">
                    <div class="wow zoomIn" data-wow-duration="400ms" data-wow-delay="0ms">
                        <ul class="pricing @if(Auth::user()->package_id == $package->id) featured @endif">
                            <li class="plan-header">
                                <div class="price-duration">
                                        <span class="price">
                                            ${{ $package->price }}
                                        </span>
                                    <span class="duration">
                                            {{ $package->validity . ' ' .trans('common.days') }}
                                        </span>
                                </div>

                                <div class="plan-name">
                                    {{ $package->name }}
                                </div>
                            </li>
                            <li>{{ trans('common.limit') }} <strong>{{ $package->limit }}</strong> {{ trans('common.emails') }}</li>
                            <li>{{ trans('common.limit') }} <strong>{{ $package->user_limit }}</strong> {{ trans('common.user(s)') }}</li>
                            <li>{{ trans('common.validity') }} <strong>{{ $package->validity }}</strong> {{ trans('common.days') }}</li>
                            
                            @if(Auth::id() != superadmin('id'))
                                <li class="plan-purchase">
                                    <a class="btn btn-primary" href="{{ url('order'. '/'. $package->id )}}" onclick="order(this, event, '{{ "redeem_coupon_$package->id" }}')">ORDER NOW</a>
                                </li>
                                <a href="#" onclick="show_redeem_coupon(this, event, '{{ "redeem_coupon_$package->id" }}')">{{ trans('common.redeem'). ' ' .trans('common.coupon') }}</a>
                                <input class="form-control" name='code' id="redeem_coupon_{{ $package->id }}" style="display: none">
                            @else
                                <li class="plan-purchase">
                                    <button name="package_id" type="submit" class="btn btn-primary" value="{{ $package->id }}">Select</button>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        {!! Form::close() !!}
    </div>
</section><!--/#pricing-->
<script>
    function show_redeem_coupon(that, e, field_id) {
        e.preventDefault();

        if($('#'+field_id).is(':visible')) {
            $(that).text("{{ trans('common.redeem'). ' ' .trans('common.coupon') }}");
            $('#'+field_id).hide('slow');
        } else {
            $(that).text("{{ trans('common.remove'). ' ' .trans('common.coupon') }}");
            $('#'+field_id).show('slow');
        }
    }

    function order(that, e, field_id) {
        e.preventDefault();
        var code = $('#'+ field_id).val();
        var url = $(that).attr('href');
        if(code) {
            url = url + '?code=' + code;
        } 
        
        window.location.href = url;
    }

</script>
@endsection