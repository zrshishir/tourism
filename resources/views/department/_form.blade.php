<div class="form-group required">
    {!! Form::label('name',trans('common.name') ,['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::text('name',null, ['id' => 'name', "required", 'class' =>'form-control','placeholder' => trans('common.department') . ' ' . trans('common.name')]) !!}
        <p class="text-danger" id="name">{{$errors->first('name')}}</p>
    </div>
</div>

<input name="for" type="hidden" id="update_id" value="{{ request()->segment(1) }}">

<div class="form-group required">

    {!! Form::label(null,null,['class'=>' col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::submit($submit_button,['class' => 'btn btn-primary', 'id' => 'submit_btn', 'onclick' => 'submit_form(event)']) !!}

    </div>
</div>

