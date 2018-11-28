
    <div class="form-group required">
        {!! Form::label('mail_provider',trans('common.mail_provider'),['class'=>' col-md-3 control-label']) !!}

        <div class="col-md-7">
            {!! Form::select('mail_provider',$mail_providers, null, ['onclick' => 'mail_provider_change(this)', 'id' => 'mail_provider_id', "required", 'class' =>'form-control', 'placeholder' => trans('common.select').' '.trans('common.mail_provider'),]) !!}
            <p class="text-danger" id="mail_provider_error">{{$errors->first('mail_provider')}}</p>

        </div>
    </div>

    <div class="form-group required credential_div" id="smtp_host_div" style="display: none;">
        {!! Form::label('smtp_host',trans('common.smtp_host_name'),['class'=>' col-md-3 control-label']) !!}

        <div class="col-md-7">
            {!! Form::text('smtp_host',null, ['id' => 'smtp_host', "required", 'class' =>'form-control credential_input', 'placeholder' => 'Enter SMTP Host']) !!}
            <p class="text-danger" id="smtp_host_error">{{$errors->first('smtp_host')}}</p>

        </div>
    </div>


    <div class="form-group required credential_div" id="smtp_username_div" style="display: none;">

        {!! Form::label('smtp_username',trans('common.smtp_username'),['class'=>'col-md-3 control-label']) !!}

        <div class="col-md-7">
            {!! Form::text('smtp_username',null, ['id' => 'smtp_username', "required", 'class' =>'form-control credential_input ', 'placeholder' => 'Enter'.' '.trans('common.smtp_username') ]) !!}
            <p class="text-danger" id="smtp_username_error">{{$errors->first('smtp_username')}}</p>

        </div>

    </div>

    <div class="form-group required credential_div" id="smtp_password_div" style="display: none">
        {!! Form::label('password', trans('common.smtp_Password'), ['class'=>'col-md-3 control-label']) !!}

        <div class="col-md-7">
            {!! Form::text('smtp_password','', ['id' => 'smtp_password', 'required' => '', 'class' => 'form-control credential_input password', 'placeholder' => 'Enter'. ' '.trans('common.smtp_Password')]) !!}
            <p class="text-danger" id="smtp_password_error"> {{ $errors->first('smtp_password')}}</p>
        </div>
    </div>




    <div class="form-group required credential_div" id="smtp_port_div" style="display: none;">

        {!! Form::label('smtp_port',trans('common.smtp_Port') ,['class'=>' col-md-3 control-label']) !!}

        <div class="col-md-7">
            {!! Form::text('smtp_port',null, ['id' => 'smtp_port', "required", 'class' =>'form-control credential_input','placeholder' => '587']) !!}
            <p class="text-danger" id="smtp_port_error">{{$errors->first('smtp_port')}}</p>

        </div>

    </div>

    <div class="form-group required credential_div" id="encryption_div" style="display: none;">

        {!! Form::label('encryption',trans('common.encryption'). ' ' . trans('common.method') ,['class'=>' col-md-3 control-label']) !!}

        <div class="col-md-7">
            {!! Form::text('encryption',null, ['id' => 'encryption', 'class' =>'form-control credential_input','placeholder' => 'tls']) !!}
            <p class="text-danger" id="encryption_error">{{$errors->first('encryption')}}</p>

        </div>

    </div>

    <div class="form-group required credential_div" id="key_div" style="display: none;">

        {!! Form::label('key',trans('common.key') ,['class'=>' col-md-3 control-label']) !!}

        <div class="col-md-7">
            {!! Form::text('key',null, ['id' => 'key', "required", 'class' =>'form-control credential_input','placeholder' => trans('common.key')]) !!}
            <p class="text-danger" id="key_error">{{$errors->first('key')}}</p>

        </div>

    </div>

    <div class="form-group required credential_div" id="domain_div" style="display: none;">

        {!! Form::label('domain',trans('common.domain') ,['class'=>' col-md-3 control-label']) !!}

        <div class="col-md-7">
            {!! Form::text('domain',null, ['id' => 'domain', "required", 'class' =>'form-control credential_input','placeholder' => trans('common.domain')]) !!}
            <p class="text-danger" id="domain_error">{{$errors->first('domain')}}</p>

        </div>

    </div>

    <div class="form-group required credential_div" id="secret_div" style="display: none;">

        {!! Form::label('secret',trans('common.secret') ,['class'=>' col-md-3 control-label']) !!}

        <div class="col-md-7">
            {!! Form::text('secret',null, ['id' => 'secret', "required", 'class' =>'form-control credential_input','placeholder' => trans('common.secret')]) !!}
            <p class="text-danger" id="secret_error">{{$errors->first('secret')}}</p>

        </div>

    </div>

    <div class="form-group required credential_div" id="region_div" style="display: none;">

        {!! Form::label('region',trans('common.region') ,['class'=>' col-md-3 control-label']) !!}

        <div class="col-md-7">
            {!! Form::text('region',null, ['id' => 'region', "required", 'class' =>'form-control credential_input','placeholder' => trans('common.region')]) !!}
            <p class="text-danger" id="region_error">{{$errors->first('region')}}</p>

        </div>

    </div>

{{--</div>--}}

    <div class="form-group required">
        {!! Form::label('from_email',trans('common.from_email') ,['class'=>' col-md-3 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('from_email',null, ['id' => 'from_email', "required", 'class' =>'form-control','placeholder' => 'your-name@your-domain.com']) !!}
            <p class="text-danger" id="from_email_error">{{$errors->first('from_email')}}</p>
        </div>
    </div>

    <div class="form-group required">
        {!! Form::label('name',trans('common.email_sender_name') ,['class'=>' col-md-3 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('name',null, ['id' => 'name', "required", 'class' =>'form-control', 'placeholder'=>'John Doe']) !!}
            <p class="text-danger" id="name_error">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="form-group required">
        {!! Form::label('name',trans('common.reply_to') ,['class'=>' col-md-3 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('reply_to',null, ['id' => 'reply_to', 'class' =>'form-control', 'placeholder'=>'reply-to@your-domain.com']) !!}
            <p class="text-danger" id="reply_to_error">{{$errors->first('reply_to')}}</p>
        </div>
    </div>

    <input type="hidden" id="update_id" value="0">

<div class="form-group required" id="submit_btn_div">

    {!! Form::label(null,null,['class'=>' col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::submit($submit_button,['class' => 'btn btn-primary', 'id' => 'submit_btn', 'onclick' => 'submit_form(event)'])!!}

    </div>

</div>

<script>
    function mail_provider_change(that) {
        
        $('.credential_div').hide('slow');
        $('.credential_input').val('');
        
        var url = "{{ url('email/load_mail_provider') }}";
        var mail_provider_id = $(that).val();
       
        if(mail_provider_id) {
            $.ajax({
                url: url + '/' + mail_provider_id,
                method: 'get',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (data) {
                    $.each(data, function (key, value) {
                        $('#' + value + '_div').show('slow');
                    });
                },
            });
        }
    }
</script>
