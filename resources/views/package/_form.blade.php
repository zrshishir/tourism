<div class="form-group required">
    {!! Form::label('name',trans('common.package'). ' '.  trans('common.name')) !!}
    {!! Form::text('name',null, ['id' => 'name', 'class' =>'form-control', 'required' => 'true']) !!}
    <p class="text-danger">{{$errors->first('name')}}</p>
</div>

<div class="form-group required">
    {!! Form::label('validity',trans('common.validity')) !!}
    {!! Form::text('validity',null, ['class' =>'form-control', 'required' => 'true' , 'placeholder' => 'Number of days']) !!}
    <p class="text-danger">{{ $errors->first('validity') }}</p>
</div>

<div class="form-group required">
    {!! Form::label('limit',trans('common.email'). ' ' .trans('common.limit')) !!}
    {!! Form::text('limit',null, ['class' =>'form-control', 'required' => 'true', 'placeholder'=> '5000']) !!}
    <p class="text-danger">{{ $errors->first('limit') }}</p>
</div>

<div class="form-group required">
    {!! Form::label('user_limit',trans('common.user'). ' ' .trans('common.limit')) !!}
    {!! Form::text('user_limit',null, ['class' =>'form-control', 'required' => 'true', 'placeholder'=> '10']) !!}
    <p class="text-danger">{{ $errors->first('user_limit') }}</p>
</div>

<div class="form-group required">
    {!! Form::label('price',trans('common.price')) !!}
    {!! Form::text('price',null, ['class' =>'form-control', 'required' => 'true', 'placeholder'=> '2']) !!}
    <p class="text-danger">{{ $errors->first('price') }}</p>
</div>

<div class="form-group">
    {!! Form::submit($submit_button,['class' => 'btn btn-sm btn-primary'])!!}
</div>