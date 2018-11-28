<div class="form-group required">
    {!! Form::label('name',trans('common.name')) !!}
    {!! Form::text('name',null, ['id' => 'name', 'class' =>'form-control', 'required' => 'true']) !!}
    <p class="text-danger">{{$errors->first('name')}}</p>
</div>

<div class="form-group required">
    {!! Form::label('faq_body',trans('common.faq')) !!}
    <span class="btn btn-link"><a href="#" onclick="loadModal()">{{ trans('common.media'). ' ' . trans('common.import')}}</a></span>
    {!! Form::textarea('faq',null, ['id' => 'faq_body', 'class' =>'form-control summernote']) !!}
    <p class="text-danger">{{ $errors->first('faq') }}</p>
</div>

<div class="form-group">
    {!! Form::submit($submit_button,['class' => 'btn btn-sm btn-primary'])!!}
</div>
