<div class="form-group required">
    {!! Form::label('request','Make Request',['class'=>' col-lg-3 control-label company-label']) !!}
    <div class="col-lg-5">
        {!! Form::text('request',null, ['id' => 'request', 'class' =>'form-control ', 'placeholder' => 'Make a request', 'required' => 'true']) !!}
        <p class="text-danger">{{$errors->first('request')}}</p>
    </div>
</div>
<div class="form-group">
    <div class="col-lg-5 col-lg-offset-3">
        {!! Form::submit($submit_button,['class' => 'btn btn-sm btn-primary pull-right'])!!}
    </div>
</div>
