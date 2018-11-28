<div class="form-group required">
    {!! Form::label('tag',trans('common.tag').' '.trans('common.name')) !!}
    {!! Form::text('name',null, ['id' => 'tag', 'class' =>'form-control', 'required' => 'true']) !!}
    <p class="text-danger">{{$errors->first('name')}}</p>
</div>

<div class="form-group">
    {!! Form::submit($submit_button,['class' => 'btn btn-sm btn-primary'])!!}
</div>