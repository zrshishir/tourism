{{--<div class="form-group required">
    {!! Form::label('message_list_id', trans('common.message_list')) !!}
        {!! Form::select('message_list_id', $messageLists, null, [ 'id' => 'message_list_id', 'class'=>'form-control', 'placeholder' => 'Select Message List', 'required' => 'true'])!!}
        <p class="text-danger">{{$errors->first('message_list_id')}}</p>
</div>--}}

<div class="form-group required">
    {!! Form::label('name',trans('common.name')) !!}
    {!! Form::text('name',null, ['id' => 'name', 'class' =>'form-control', 'required' => 'true']) !!}
    <p class="text-danger">{{$errors->first('name')}}</p>
</div>

<div class="form-group required">
    {!! Form::label('template',trans('common.newsletter')) !!}
    <span class="btn btn-link"><a href="#" onclick="loadModal()">{{ trans('common.media'). ' ' . trans('common.import')}}</a></span>
    {!! Form::textarea('template',null, ['id' => 'summernote', 'class' =>'form-control', 'required' => 'true']) !!}
    <p class="text-danger">{{ $errors->first('template') }}</p>
</div>

<div class="form-group">
    {!! Form::submit($submit_button,['class' => 'btn btn-sm btn-primary'])!!}
</div>