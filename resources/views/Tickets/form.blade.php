<!-- <div class="form-group required">
    {!! Form::label('from_email',trans('tickets.code') ,['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::text('code',null, ['id' => 'code', "required", 'class' =>'form-control','placeholder' => trans('tickets.code')]) !!}
        <p class="text-danger" id="code">{{$errors->first('code')}}</p>
    </div>
</div> -->

<div class="form-group required">
    {!! Form::label('from_email',trans('tickets.subject') ,['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::text('subject',null, ['id' => 'subject', "required", 'class' =>'form-control','placeholder' => trans('tickets.subject')]) !!}
        <p class="text-danger" id="subject_error">{{$errors->first('subject')}}</p>
    </div>
</div>

@if(superadmin('id') == Auth::id() || user_or_customer_info(Auth::id(), 'customer_id') == superadmin('id'))
    <div class="form-group required">
        {!! Form::label('reporter',trans('common.select'). ' '.  trans('tickets.reporter'),['class'=> 'col-lg-3 control-label']) !!}
        <div class="col-lg-7">
            {!! Form::select('reporter', $reporters, null , ['id' => 'reporter', 'class'=>'form-control select_box','style'=>'width:100%'])!!}
            <p class="text-danger" id="reporter_error">{{$errors->first('reporter')}}</p>
        </div>
    </div>

    <div class="form-group required">
        {!! Form::label('priority',trans('tickets.priority'),['class'=> 'col-lg-3 control-label']) !!}
        <div class="col-lg-7">
            {!! Form::select('priority', $priority,null , ['id' => 'priority', 'class'=>'form-control select_box','style'=>'width:100%'])!!}
            <p class="text-danger" id="priority_error">{{$errors->first('priority')}}</p>
        </div>
    </div>
@endif

<div class="form-group required">
    {!! Form::label('department_id',trans('tickets.department'),['class'=> 'col-lg-3 control-label']) !!}
    <div class="col-lg-7">
        {!! Form::select('department_id', $department,null , ['id' => 'department_id', 'class'=>'form-control select_box','style'=>'width:100%'])!!}
        <p class="text-danger" id="department_id_error">{{$errors->first('department_id')}}</p>
    </div>
</div>


<div class="form-group required">
    {!! Form::label('reason',trans('tickets.body') ,['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::textarea('reason',null, ['id' => 'reason',"required", 'class' =>'form-control textarea', 'placeholder'=>trans('common.reason')]) !!}
        <p class="text-danger" id="reason_error">{{$errors->first('reason')}}</p>
    </div>
</div>
<div id="add_new">
    <div id="edit_attach" style="display: none">

    </div>

    <div class="form-group" style="margin-bottom: 0px">
        <label for="field-1" class="col-sm-3 control-label">{!! trans('common.attachment') !!}</label>
        <div class="col-sm-5">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <span class="btn btn-default btn-file"><span class="fileinput-new">{!! trans('common.select_file') !!}</span>
                    <span class="fileinput-exists">{!! trans('common.change') !!}</span>
                    <input type="file" name="upload_file[]">
                </span>

                <span class="fileinput-filename"></span>
                
                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">×</a>
            </div>
            <div id="msg_pdf" style="color: #e11221"></div>
        </div>
        <div class="col-sm-2">
            <strong><a href="javascript:void(0);" id="add_more" class="addCF "><i class="fa fa-plus"></i>&nbsp;Add More                                </a></strong>
        </div>
    </div>
</div>
<div class="col-sm-7 col-sm-offset-3">
    <p class="text-danger" id="ext_error"></p>
</div>


<input type="hidden" name="created_by" value="{{ Auth::id() }}">

<input type="hidden" id="update_id" value="0">


<div class="form-group required">

    {!! Form::label(null,null,['class'=>' col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::submit($submit_button,['class' => 'btn btn-primary', 'id' => 'submit_btn', 'onclick' => 'submit_form(event)'])!!}

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var maxAppend = 0;
        $("#add_more").click(function () {

            var add_new = $('<div class="form-group" style="margin-bottom: 0px">\n\
                    <label for="field-1" class="col-sm-3 control-label">{!! trans('common.attachment') !!}</label>\n\
        <div class="col-sm-5">\n\
        <div class="fileinput fileinput-new" data-provides="fileinput">\n\
<span class="btn btn-default btn-file"><span class="fileinput-new" >Select File</span><span class="fileinput-exists" >Change</span><input type="file" name="upload_file[]" ></span> <span class="fileinput-filename"></span><a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a></div></div>\n\<div class="col-sm-2">\n\<strong>\n\
<a href="javascript:void(0);" class="remCF"><i class="fa fa-times"></i>&nbsp;{!! trans('common.remove') !!}</a></strong></div>');
            maxAppend++;
            $("#add_new").append(add_new);

        });

        $("#add_new").on('click', '.remCF', function () {
            $(this).parent().parent().parent().remove();
        });
        $('a.RCF').click(function () {
            $(this).parent().parent().remove();
        });
    });
</script>