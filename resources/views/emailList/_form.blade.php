@if(! isset($groupList))

{{--<span class="col-lg-offset-3">Or</span>--}}

<div class="form-group required">
    {!! Form::label('group_name',trans('common.select'). ' '.  trans('common.group_name'),['class'=> 'col-lg-3 control-label']) !!}
    <div class="col-lg-5">
        {!! Form::select('select_group_name[]', $groupNames, null, [ 'multiple', 'class'=>'form-control select_2_to','style'=>'width:100%', 'required' => 'true'])!!}
        <p class="text-danger">{{$errors->first('select_group_name')}}</p>
    </div>
</div>

<div class="form-group required">
    {!! Form::label('emails',trans('common.emails'),['class'=>' col-lg-3 control-label']) !!}
    <div class="col-lg-5">
        {!! Form::textarea('emails',null, ['id' => 'emails', 'class' =>'form-control', 'placeholder'=>"support@" . $_SERVER['HTTP_HOST']. ", info@" . $_SERVER['HTTP_HOST']. ", help@" . $_SERVER['HTTP_HOST']. ""]) !!}
        <p class="text-danger">{{$errors->first('emails')}}</p>
    </div>
</div>

<div class="form-group required">
    {!! Form::label('upload_file',trans('common.upload_file'),['class'=>' col-lg-3 control-label']) !!}
    <div class="col-lg-5">
        {!! Form::file('excel_file',null, true, ['id' => 'upload_file', 'class' =>'form-control']) !!}
        <p class="text-danger">{{$errors->first('excel_file')}}</p>
        <p class="text-danger">{{$errors->first('ext')}}</p>
        <span><a href="{{url('download_sample')}}">Download Sample Email List</a></span>
    </div>
</div>

@else 
<div class="form-group required">
    {!! Form::label('group_name',  trans('common.group_name'),['class'=> 'col-lg-3 control-label']) !!}
    <div class="col-lg-5">
    {!! Form::text('name',null, ['id' => 'group_name', 'class' =>'form-control', 'required' => 'true']) !!}
        <p class="text-danger">{{$errors->first('name')}}</p>
    </div>
</div>
@endif

<div class="form-group">
    <div class="col-lg-5 col-lg-offset-3">
        {!! Form::submit($submit_button,['class' => 'btn btn-sm btn-primary pull-right'])!!}
    </div>
</div>
