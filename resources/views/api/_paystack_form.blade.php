<div class="form-group required">

    {!! Form::label('paystack_secret',trans('common.paystack').' '.trans('common.secret'). ' ' . trans('common.key'),['class'=>'col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::text('paystack_secret', ($paystack_secret && (env('APP_ENV', false) != 'demo')) ? $paystack_secret : null, ['id' => 'paystack_secret', 'class' =>'form-control ', 'placeholder' => trans('common.paystack').' '.trans('common.secret'). ' ' . trans('common.key'), 'required' => 'true']) !!}
        <p class="text-danger">{{$errors->first('paystack_secret')}}</p>

    </div>
</div>

<div class="form-group required">

    {!! Form::label('paystack_public',trans('common.paystack').' '.trans('common.public'). ' ' . trans('common.key'),['class'=>'col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::text('paystack_public', null, ['id' => 'paystack_public', 'class' =>'form-control ', 'placeholder' => trans('common.paystack').' '.trans('common.public'). ' ' . trans('common.key'), 'required' => 'true']) !!}
        <p class="text-danger">{{$errors->first('paystack_public')}}</p>

    </div>
</div>

<div class="form-group required">

{!! Form::label('paystack_email',trans('common.paystack').' '.trans('common.email'),['class'=>'col-md-3 control-label']) !!}

<div class="col-md-7">
    {!! Form::text('paystack_email', null, ['id' => 'paystack_email', 'class' =>'form-control ', 'placeholder' => trans('common.paystack').' '.trans('common.email'), 'required' => 'true']) !!}
    <p class="text-danger">{{$errors->first('paystack_email')}}</p>

</div>
</div>

<div class="form-group required">

{!! Form::label('paystack_urlapi',trans('common.paystack').' '.trans('common.urlapi'),['class'=>'col-md-3 control-label']) !!}

<div class="col-md-7">
    {!! Form::text('paystack_urlapi', null, ['id' => 'paystack_urlapi', 'class' =>'form-control ', 'placeholder' => trans('common.paystack_api'), 'required' => 'true']) !!}
    <p class="text-danger">{{$errors->first('paystack_urlapi')}}</p>

</div>
</div>

<div class="form-group required">

    {!! Form::label(null,null,['class'=>' col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::submit($submit_button,['class' => 'btn btn-primary'])!!}

    </div>

</div>