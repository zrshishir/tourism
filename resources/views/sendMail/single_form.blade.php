<div class="form-group required">
    {!! Form::label('group_name',trans('common.select'). ' '.  trans('common.group_name'),['class'=> 'col-lg-3 control-label']) !!}
    <div class="col-lg-5">
        {!! Form::select('select_group_name[]', $groups, null, [ 'multiple', 'class'=>'form-control select_2_to','style'=>'width:100%', 'required' => 'true'])!!}
        <p class="text-danger">{{$errors->first('select_group_name')}}</p>
    </div>
</div>

<div class="form-group required">
    {!! Form::label('emails',trans('common.emails') .' ' . trans('common.addresses'),['class'=>' col-lg-3 control-label']) !!}
    <div class="col-lg-5">
        {!! Form::textarea('emails',null, ['id' => 'emails', 'class' =>'form-control ']) !!}
        <p class="text-danger">{{$errors->first('emails')}}</p>
    </div>
</div>

<!-- <div class="form-group required">
    {!! Form::label('upload_file',trans('common.upload_file'),['class'=>' col-lg-3 control-label']) !!}
    <div class="col-lg-5">
        {!! Form::file('excel_file',null, ['id' => 'upload_file', 'class' =>'form-control ']) !!}
        <p class="text-danger">{{$errors->first('excel_file')}}</p>
        <p class="text-danger">{{$errors->first('ext')}}</p>
        <span><a href="{{url('download_sample')}}">Download Sample Email List</a></span>
    </div>
</div> -->

<div class="form-group required">
    {!! Form::label('template', trans('common.template'),['class'=> 'col-lg-3 control-label']) !!}
    <div class="col-lg-5">
        <div class="input-group">
            {!! Form::select('template', $templates, null, [ 'id' => 'select_template_single', 'class'=>'form-control', 'required' => 'true'])!!}
            @if(!count($templates) > 0)
                <span class="pull-right"><a href="{{url('template')}}">Please Create {{trans('common.template')}} first.</a></span>
            @endif
            <div class="input-group-addon" onclick="show_template()"><a href="#"><i class="fa fa-list-alt text-primary"></i></a></div>
        </div>    
        <p class="text-danger">{{$errors->first('template')}}</p>
    </div>
</div>

<div class="form-group required">
    {!! Form::label('subject',trans('common.subject'),['class'=>' col-lg-3 control-label']) !!}
    <div class="col-lg-5">
        {!! Form::text('subject',null, ['id' => 'subject', 'class' =>'form-control ', 'required' => 'true']) !!}
        <p class="text-danger">{{$errors->first('subject')}}</p>
    </div>
</div>
<input type="hidden" name="email_identifier" value="emails">

<div class="form-group">
    {!! Form::label('attachment',trans('common.select'). ' '.  trans('common.attachment'),['class'=> 'col-lg-3 control-label']) !!}
    <div class="col-lg-5">
        {!! Form::select('select_attachment[]', $attachments, null, [ 'multiple', 'class'=>'form-control select_2_to','style'=>'width:100%'])!!}
        <p class="text-danger">{{$errors->first('attachment')}}</p>
    </div>
</div>

@if(isset($send_later))
<div class="form-group" id="div_schedule_email">
    <div class="col-lg-6 control-label">
        <span class="label label-warning"><a href="#" class="schedule_email"
                                             style="color: white; font-size: 10px;">{{ trans('common.send_later') }}</a></span>
    </div>
</div>
@endif

<div class="form-group" id="datetime_email_div" style="display: none">
    {!! Form::label('subject',trans('common.select').' '.trans('common.date_time'),['class'=>' col-lg-3 control-label']) !!}
    <div class="col-lg-5">
        <div class="datetime" id="datetimepicker_inline">
            <input type='hidden' name="datetime" class="form-control" />
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker_inline').datetimepicker({
            inline: true,
            sideBySide: true,
            format: 'D-M-Y hh:mm a'
        });
    });
</script>

<div class="form-group" style="display: none" id="remove_schedule_email">
    <div class="col-lg-6 control-label">
        <span class="label label-danger"><a href="#" class="schedule_email"
                                            style="color: white; font-size: 10px;">{{ trans('common.remove_send_later') }}</a></span>
    </div>
</div>

<input type="hidden" id="send_later_identifier_email" name="send_later_email" value="0">

<input type="hidden" id="timezone" name="timezone" value="0">

<div class="form-group">
    <div class="col-lg-5 col-lg-offset-3">
        {!! Form::reset('Reset',['class' => 'btn btn-sm btn-info'])!!}
        {!! Form::submit($submit_button,['class' => 'btn btn-sm btn-primary pull-right confirm-swl'])!!}
    </div>
</div>