<div class="form-group required">

    {!! Form::label('stripe_secret',trans('common.stripe').' '.trans('common.secret'). ' ' . trans('common.key'),['class'=>'col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::text('stripe_secret', ($stripe_secret && (env('APP_ENV', false) != 'demo')) ? $stripe_secret : null, ['id' => 'stripe_secret', 'class' =>'form-control ', 'placeholder' => trans('common.stripe').' '.trans('common.secret'). ' ' . trans('common.key'), 'required' => 'true']) !!}
        <p class="text-danger">{{$errors->first('stripe_secret')}}</p>

    </div>
</div>

<div class="form-group required">

    {!! Form::label(null,null,['class'=>' col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::submit($submit_button,['class' => 'btn btn-primary'])!!}

    </div>

</div>