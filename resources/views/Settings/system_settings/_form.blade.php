<div class="form-group required">
    {!! Form::label('site_desciption',trans('common.site_description'),['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::text('site_description',configValue('site_description')?configValue('site_description'):null, ['class' =>'form-control ', 'placeholder' => trans('common.enter').' '.trans('common.site_description')]) !!}
        <p class="text-danger">{{$errors->first('site_description')}}</p>
    </div>
</div>
<div class="form-group required">
    {!! Form::label('site_keyword',trans('common.site_keyword'),['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::text('site_keyword',configValue('site_keyword')?configValue('site_keyword'):null, ['class' =>'form-control ', 'placeholder' => trans('common.enter').' '.trans('common.site_keyword')]) !!}
        <p class="text-danger">{{$errors->first('site_keyword')}}</p>
    </div>
</div>

<div class="form-group required">
    {!! Form::label('disqusShortname',trans('common.disqusShortname'),['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::text('disqusShortname',configValue('disqusShortname')?configValue('disqusShortname'):null, ['class' =>'form-control ', 'placeholder' => trans('common.enter').' '.trans('common.disqusShortname')]) !!}
        <span class="pull-right"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> <a href="http://disqus.com" target="_blank">disqus</a></span>
        <p class="text-danger">{{$errors->first('disqusShortname')}}</p>
    </div>
</div>

<div class="form-group required">
    {!! Form::label('attachment_type',trans('common.attachment_type'),['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::select('attachment_type[]', $attachment_types, null, [ 'id' => 'attachment_type','multiple', 'class'=>'form-control select_2_to','style'=>'width:100%'])!!}
        <p class="text-danger">{{$errors->first('attachment_type')}}</p>
    </div>
</div>
{{--<div class="form-group required">--}}
    {{--{!! Form::label('default_language',trans('common.default_language'),['class'=>' col-md-3 control-label']) !!}--}}
    {{--<div class="col-md-7">--}}
        {{--{!! Form::select('default_language',['on'=>trans('common.on'),'off'=>trans('common.off')],configValue('default_language'), ['class' =>'form-control select_box']) !!}--}}
        {{--<p class="text-danger">{{$errors->first('default_language')}}</p>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group required">--}}
    {{--{!! Form::label('item_per_page',trans('common.item_per_page'),['class'=>' col-md-3 control-label']) !!}--}}
    {{--<div class="col-md-7">--}}
        {{--{!! Form::select('item_per_page',['10'=>10,'20'=>20,'25'=>25,'40'=>40,'50'=>50,'100'=>100,],configValue('item_per_page'), ['class' =>'form-control select_box']) !!}--}}
        {{--<p class="text-danger">{{$errors->first('item_per_page')}}</p>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group required">--}}
    {{--{!! Form::label('default_mailer',trans('common.default_mailer'),['class'=>' col-md-3 control-label']) !!}--}}
    {{--<div class="col-md-7">--}}
        {{--{!! Form::select('default_mailer',['on'=>trans('common.on'),'off'=>trans('common.off')],configValue('default_mailer'), ['class' =>'form-control select_box']) !!}--}}
        {{--<p class="text-danger">{{$errors->first('default_mailer')}}</p>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="form-group required">--}}
    {{--{!! Form::label('site_status',trans('common.site_status'),['class'=>' col-md-3 control-label']) !!}--}}
    {{--<div class="col-md-7">--}}
        {{--{!! Form::select('site_status',['on'=>trans('common.on'),'off'=>trans('common.off')],configValue('site_status'), ['class' =>'form-control select_box site_status ']) !!}--}}
        {{--<p class="text-danger">{{$errors->first('site_status')}}</p>--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group offline_message" style="display: none;">
    {!! Form::label('offline_message',trans('common.offline_message'),['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::textarea('offline_message',configValue('offline_message')?configValue('offline_message'):null, ['style'=>'height:80px;weight:80px','class' =>'form-control']) !!}
        <p class="text-danger">{{$errors->first('offline_message')}}</p>
    </div>
</div>

<div class="form-group required">
    {!! Form::label('copyright',trans('common.copyright'),['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::text('copyright',configValue('copyright'), ['class' =>'form-control site_status ']) !!}
        <p class="text-danger">{{$errors->first('copyright')}}</p>
    </div>
</div>



<div class="form-group required">
    {!! Form::label(null,null,['class'=>' col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::submit($submit_button,['class' => 'btn btn-primary'])!!}
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        @if(configValue('site_status') == 'on')
            $('.offline_message').show();
        @endif


        $('.site_status').change(function () {
            if ($('.site_status').val() == 'on') {
                $('.offline_message').show();
            } else {
                $('.offline_message').hide();
            }
        });

        @if(configValue("attachment_type"))
            $('#attachment_type').select2('val', $.parseJSON('{!! configValue("attachment_type") !!}'));
        @endif

    });
</script>
