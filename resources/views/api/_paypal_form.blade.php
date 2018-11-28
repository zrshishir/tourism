<div class="form-group required">
    {!! Form::label('client_id',trans('common.paypal') .' '.trans('common.client_id'),['class'=>' col-md-3 control-label']) !!}


    <div class="col-md-7">
        {!! Form::text('client_id', ($client_id && (env('APP_ENV', false) != 'demo') ) ? $client_id : null, ['id' => 'client_id', 'class' =>'form-control', 'placeholder' => trans('common.enter').' '.trans('common.paypal') .' ' . trans('common.client_id'), 'required' => 'true']) !!}
        <p class="text-danger">{{$errors->first('client_id')}}</p>

    </div>
</div>


<div class="form-group required">

    {!! Form::label('client_secret',trans('common.paypal').' '.trans('common.client_secret'),['class'=>'col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::text('client_secret', ($client_secret && (env('APP_ENV', false) != 'demo')) ? $client_secret : null, ['id' => 'client_secret', 'class' =>'form-control ', 'placeholder' => trans('common.enter').' '.trans('common.paypal').' '.trans('common.client_secret'), 'required' => 'true']) !!}
        <p class="text-danger">{{$errors->first('client_secret')}}</p>

    </div>
</div>

<div class="form-group required">

    {!! Form::label(null,null,['class'=>' col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::submit($submit_button,['class' => 'btn btn-primary'])!!}

    </div>

</div>