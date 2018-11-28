<div class="form-group required">
    {!! Form::label('name',trans('auth.fullname'),['class'=>' col-lg-3 control-label company-label']) !!}
    <div class="col-lg-5">
        {!! Form::text('name',null, ['id' => 'name', 'class' =>'form-control ', 'placeholder' => trans('auth.fullname'), 'required' => 'true']) !!}
        <p class="text-danger">{{$errors->first('name')}}</p>
    </div>
</div>
<div class="form-group required">
    {!! Form::label('email',trans('common.email'),['class'=>' col-lg-3 control-label company-label']) !!}
    <div class="col-lg-5">
        {!! Form::text('email',null, ['id' => 'email', 'class' =>'form-control ', 'placeholder' => trans('common.email'). ' '.trans('common.address'), 'required' => 'true']) !!}
        <p class="text-danger">{{$errors->first('email')}}</p>
    </div>
</div>
<div class="form-group required">
    {!! Form::label('password',trans('common.password'),['class'=>' col-lg-3 control-label company-label']) !!}
    <div class="col-lg-5">
        {!! Form::password('password', ['id' => 'password', 'class' =>'form-control ', 'placeholder' => trans('common.new'). ' '.trans('common.password'), 'maxlength' => '50']) !!}
        <p class="text-danger">{{$errors->first('password')}}</p>
    </div>
</div>
<div class="form-group required">
    {!! Form::label('confirm_password',trans('common.confirm'). ' ' .trans('common.password'),['class'=>' col-lg-3 control-label company-label']) !!}
    <div class="col-lg-5">
        {!! Form::password('confirm_password', ['id' => 'confirm_password', 'class' =>'form-control ','placeholder' => trans('common.confirm'). ' '.trans('common.password'), 'maxlength' => '50']) !!}
        <p class="text-danger">{{$errors->first('confirm_password')}}</p>
    </div>
</div>

<div class="form-group required" id="select_department_div">
    {!! Form::label('select_department', trans('common.select'). ' ' .trans('common.department'),['class'=> 'col-lg-3 control-label']) !!}
    <div class="col-lg-5">
        {!! Form::select('role', $departments, null, [ 'id' => 'select_department', 'class'=>'form-control select_multi','style'=>'width:100%'])!!}
        <p class="text-danger">{{$errors->first('department_id')}}</p>
    </div>
</div>


<div class="form-group">
    <div class="col-lg-5 col-lg-offset-3">
        {!! Form::submit($submit_button,['class' => 'btn btn-sm btn-primary pull-right'])!!}
    </div>
</div>
