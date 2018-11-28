<div class="form-group required">
    {{ Form::radio('payment', 'paypal', true, ['class' => 'payment without-paystack']) }}
    {!! Form::label('payment',trans('common.pay_with_paypal')) !!}
    <p class="text-danger">{{$errors->first('payment')}}</p>
</div>

<div class="form-group required">
    {{ Form::radio('payment', 'paystack', null, ['id' =>'paystack','class' => 'payment']) }}
    {!! Form::label('paystack',trans('common.pay_with_paystack')) !!}
    <p class="text-danger">{{$errors->first('payment')}}</p>
</div>

<div class="form-group required">
    {{ Form::radio('payment', 'card', null, ['class' => 'payment without-paystack']) }}
    {!! Form::label('payment',trans('common.pay_with_card')) !!}
    <p class="text-danger">{{$errors->first('payment')}}</p>
</div>
<input type="hidden" name="package_id" value="{{ $package->id }}">
@if(isset($coupon))
    <input type="hidden" name="code" value="{{ $coupon->code }}">
@endif    
<div class="row" style="display: none;" id="div_pay_with_card">
    <div class="col-md-6">
        <div class="form-group required">
            {!! Form::label('number',trans('common.card_number')) !!}
            {!! Form::text('number',null, ['id' => 'number', 'class' =>'form-control', 'placeholder' => trans('common.card_number')]) !!}
            <p class="text-danger">{{$errors->first('number')}}</p>
        </div>
        <div class="form-group required">
            {!! Form::label('exp_month',trans('common.expired_month')) !!}
            {!! Form::text('exp_month',null, ['id' => 'exp_month', 'class' =>'form-control', 'placeholder' => 'MM']) !!}
            <p class="text-danger">{{$errors->first('exp_month')}}</p>
        </div>

        <div class="form-group required">
            {!! Form::label('exp_year',trans('common.expired_year')) !!}
            {!! Form::text('exp_year',null, ['id' => 'exp_year', 'class' =>'form-control', 'placeholder' => 'YY']) !!}
            <p class="text-danger">{{$errors->first('exp_month')}}</p>
        </div>
        <div class="form-group required">
            {!! Form::label('cvc',trans('common.CVC')) !!}
            {!! Form::text('cvc',null, ['id' => 'cvc', 'class' =>'form-control', 'placeholder' => trans('common.CVC')]) !!}
            <p class="text-danger">{{$errors->first('cvc')}}</p>
        </div>
    </div>
</div>

<div style="display: none;" id="div_pay_with_paystack">
    <div class="col-md-6">
        <div class="form-group required">
            
            {!! Form::hidden('email', $marchantEmail, [ 'class' =>'form-control']) !!}
        </div>
        <div class="form-group required">
           
            {!! Form::hidden('orderId', $packageId, [ 'class' =>'form-control']) !!}
        </div>

        <div class="form-group required">
         
            {!! Form::hidden('amount',$price*100, [ 'class' =>'form-control']) !!}
        </div>
        <div class="form-group required">
         
            {!! Form::hidden('quantity',1, [ 'class' =>'form-control']) !!}
        </div>
        <div class="form-group required">
         
            {!! Form::hidden('metadata',null, [ 'class' =>'form-control']) !!}
        </div>
        <div class="form-group required">
         
            {!! Form::hidden('reference',$reference, [ 'class' =>'form-control']) !!}
        </div>
        <div class="form-group required">
         
            {!! Form::hidden('key',$secretKey, [ 'class' =>'form-control']) !!}
        </div>
    </div>
</div>

<hr>
<?php $price = $package->price; ?>
@if(isset($coupon))
{{ trans('common.package'). ' ' .trans('common.price'). ' : '. $package->price}}<br>
    {{ trans('common.coupon'). ' ' .trans('common.price'). ' ' . trans('common.off') . ' : '}}
    @if($coupon->amount_type == 'fixed_amount')
        {{ '$'. $coupon->discount_amount }}<br>
        <?php $price = $price - $coupon->discount_amount; ?>
    @elseif($coupon->amount_type == 'percentage_amount')
    <?php $price = $price - ($price * $coupon->discount_amount / 100); ?>
        {{ $coupon->discount_amount. '%' }}<br>
    @endif
@endif
<label class="text-primary">{{ trans('common.payable_amount'). ' : $'. $price }}</label>
<br>
<br>
<div class="form-group">
    {!! Form::submit($submit_button,['class' => 'btn btn-sm btn-primary'])!!}
</div>

<script>
    $('.payment').click(function(e){
        if($(this).val() == 'card'){
            $('#div_pay_with_card').show('slow');
        } else {
            $('#div_pay_with_card').hide('slow');
        }
        if($(this).val() == 'paystack'){
            $('#div_pay_with_paystack').show();
        } else {
            $('#div_pay_with_paystack').hide();
        }
    });

    $(function(){

        var baseUrl = '{{ url("/") }}'; 
        @if (count($errors) > 0 && old('payment') == 'card')
            $('#div_pay_with_card').show();
        @endif

        $('#paystack').click(function(){
            if($('#paystack').is(':checked')){
                $('#payment').attr('action', baseUrl + '/payment_paystack');
            }
        });
        $('.without-paystack').click(function(){
            if($('.without-paystack').is(':checked')){
                $('#payment').attr('action', baseUrl + '/payment');
            }
        });
    });
</script>