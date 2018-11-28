<div class="form-group required">
    {!! Form::label('group_name', trans('common.name') ,['class'=>' col-lg-3 control-label company-label']) !!}
    <div class="col-lg-5">
        {!! Form::text('name',null, ['id' => 'name', 'class' =>'form-control', 'autocomplete' => 'off']) !!}
        <p class="text-danger">{{$errors->first('name')}}</p>
    </div>
</div>

<div class="form-group">
    <div class="col-lg-5 col-lg-offset-3">
        {!! Form::submit($submit_button,['class' => 'btn btn-sm btn-primary pull-right'])!!}
    </div>
</div>