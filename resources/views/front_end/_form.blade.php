<div class="form-group required">
    {!! Form::label('menu',trans('common.menu')) !!}
        {!! Form::text('menu',null, ['id' => 'menu', "required", 'class' =>'form-control','placeholder' => trans('common.menu')]) !!}
        <p class="text-danger" id="menu_error">{{$errors->first('menu')}}</p>
</div>

<div class="form-group required">
    {!! Form::label('description',trans('common.description')) !!}
        {!! Form::text('description',null, ['id' => 'description', "required", 'class' =>'form-control summernote','placeholder' => trans('common.description')]) !!}
        <p class="text-danger" id="description_error">{{$errors->first('description')}}</p>
</div>

<input name="for" type="hidden" id="update_id" value="{{ request()->segment(1) }}">

<div class="form-group required">

    {!! Form::label(null,null) !!}

    {!! Form::submit($submit_button,['class' => 'btn btn-primary', 'id' => 'submit_btn', 'onclick' => 'submit_form(event)']) !!}
</div>