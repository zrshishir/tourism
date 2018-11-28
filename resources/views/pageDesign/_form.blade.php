{{--<div class="form-group required">
    {!! Form::label('message_list_id', trans('common.message_list')) !!}
        {!! Form::select('message_list_id', $messageLists, null, [ 'id' => 'message_list_id', 'class'=>'form-control', 'placeholder' => 'Select Message List', 'required' => 'true'])!!}
        <p class="text-danger">{{$errors->first('message_list_id')}}</p>
</div>--}}
<!-- <a href="{{ url('htmlTemplate') }}"
   data-toggle="tooltip" data-placement="top" data-title="{{ trans('common.create_html_template') }}"
   class="btn btn-primary btn-sm pull-right">
    <i class="fa fa-plus"></i> {{ trans('common.HTML'). ' ' .trans('common.template') }}
</a> -->

<div class="form-group required">
    {!! Form::label('name',trans('common.name')) !!}
    {!! Form::text('name',null, ['id' => 'name', 'class' =>'form-control', 'required' => 'true']) !!}
    <p class="text-danger">{{$errors->first('name')}}</p>
</div>

<div class="form-group required">
    {!! Form::label('template_body',trans('common.page')) !!}
    <span class="btn btn-link"><a href="#" onclick="loadModal()">{{ trans('common.media'). ' ' . trans('common.import')}}</a></span>
    {!! Form::textarea('template',null, ['id' => 'template_body', 'class' =>'summernote form-control']) !!}
    <p class="text-danger">{{ $errors->first('template') }}</p>
    <span class="text-danger">Use this variable {USERNAME} to show user name</span>
</div>

<div class="form-group">
    {!! Form::submit($submit_button,['class' => 'btn btn-sm btn-primary', 'id'=>'htmlvalidation'])!!}
</div>

