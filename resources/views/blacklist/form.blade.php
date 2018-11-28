<div class="form-group required">
    {!! Form::label('from_email',trans('blacklist.'.explode("_",request()->segment(1))[0]) ,['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::text('name',null, ['id' => 'name', "required", 'class' =>'form-control','placeholder' => trans('blacklist.'.explode("_",request()->segment(1))[0])]) !!}
        <p class="text-danger" id="name">{{$errors->first('name')}}</p>
    </div>
</div>

<div class="form-group required">
    {!! Form::label('reason',trans('common.reason') ,['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::textarea('reason',null, ['id' => 'reason', 'style'=>'height:100px',"required", 'class' =>'form-control', 'placeholder'=>trans('common.reason')]) !!}
        <p class="text-danger" id="reason">{{$errors->first('reason')}}</p>
    </div>
</div>

@if(Auth::id() == superadmin('id'))
<div class="form-group required">
    {!! Form::label('select_customer',trans('common.select'). ' '.  trans('common.customer'),['class'=> 'col-lg-3 control-label']) !!}
    <div class="col-lg-7">
        {!! Form::select('select_customer[]', $customers,null , ['id' => 'select_customer', 'multiple', 'class'=>'form-control select_multi','style'=>'width:100%'])!!}
        <p class="text-danger">{{$errors->first('select_customer')}}</p>
    </div>
</div>
@endif

<input type="hidden" name="created_by" value="{{ Auth::id() }}">

<input type="hidden" id="update_id" value="0">

<input name="for" type="hidden" id="update_id" value="{{ request()->segment(1) }}">

<div class="form-group required">

    {!! Form::label(null,null,['class'=>' col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::submit($submit_button,['class' => 'btn btn-primary', 'id' => 'submit_btn', 'onclick' => 'submit_form(event)'])!!}

    </div>
</div>

