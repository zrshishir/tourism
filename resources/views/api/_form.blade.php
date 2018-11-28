@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="form-group required">
    {!! Form::label('bulkemailchecker',trans('common.bulkemailchecker') .' '.trans('common.key'),['class'=>' col-md-3 control-label']) !!}


    <div class="col-md-7">
        {!! Form::text('bulkemailchecker', ($bulkEmailChecker && (env('APP_ENV', false) != 'demo') ) ? $bulkEmailChecker->key : null, ['id' => 'bulkemailchecker', 'class' =>'form-control', 'placeholder' => trans('common.enter').' '.trans('common.bulkemailchecker') .' ' . trans('common.key')]) !!}
        <span class="pull-right" data-toggle='tooltip' title="{{'Click here to know more about ' . trans('common.bulkemailchecker')}}">
           <i class="fa fa-question-circle" aria-hidden="true"></i>
            <a href="https://bulkemailchecker.com/"
                                    target="_blank">{{trans('common.bulkemailchecker')}}</a>
        </span>
        {{$errors->first('bulkemailchecker')}}

    </div>
</div>

<div class="form-group required">
    {!! Form::label('bulkemailchecker_url',trans('common.bulkemailchecker') .' '.trans('common.url'),['class'=>' col-md-3 control-label']) !!}


    <div class="col-md-7">
        {!! Form::text('bulkemailchecker_url', ($bulkEmailChecker && (env('APP_ENV', false) != 'demo') ) ? $bulkEmailChecker->url : null, ['id' => 'bulkemailchecker_url', 'class' =>'form-control', 'placeholder' => trans('common.enter').' '.trans('common.bulkemailchecker') .' ' . trans('common.url')]) !!}
        <span class="pull-right" data-toggle='tooltip' title="{{'Click here to know more about ' . trans('common.bulkemailchecker')}}">
           <i class="fa fa-question-circle" aria-hidden="true"></i>
            <a href="https://bulkemailchecker.com/"
                                    target="_blank">{{trans('common.bulkemailchecker')}}</a>
        </span>
        {{$errors->first('bulkemailchecker_url')}}

    </div>
</div>

<hr>

<div class="form-group required">

    {!! Form::label('emaillistverify',trans('common.emaillistverify').' '.trans('common.key'),['class'=>'col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::text('emaillistverify', ($emailListVerify && (env('APP_ENV', false) != 'demo')) ? $emailListVerify->key : null, ['id' => 'emaillistverify', 'class' =>'form-control ', 'placeholder' => trans('common.enter').' '.trans('common.emaillistverify').' '.trans('common.key')]) !!}
        <span class="pull-right" title="{{'Click here to know more about ' . trans('common.emaillistverify')}}" data-toggle="tooltip">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
            <a href="http://emaillistverify.com/" target="_blank">{{trans('common.emaillistverify')}}</a>
        </span>
        {{$errors->first('emaillistverify')}}

    </div>
</div>

<div class="form-group required">

    {!! Form::label(null,null,['class'=>' col-md-3 control-label']) !!}

    <div class="col-md-7">
        {!! Form::submit($submit_button,['class' => 'btn btn-primary'])!!}

    </div>

</div>