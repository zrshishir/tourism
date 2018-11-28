<div class="row">
    <div class="col-md-6">
        <div class="form-group required">
            {!! Form::label('name',trans('common.name') ,['class'=>' control-label']) !!}
                {!! Form::text('name',null, ['id' => 'name', "required", 'class' =>'form-control','placeholder' => trans('common.name')]) !!}
                <p class="text-danger" id="name">{{$errors->first('name')}}</p>
        </div>
        <div class="form-group required">
            {!! Form::label('package_id',trans('common.select').' '.trans('common.package') ,['class'=>' control-label']) !!}
                {!! Form::select('package_id[]', $packages, null, [ 'id' => 'select_package','multiple', "required", 'class'=>'form-control select_multi','style'=>'width:100%'])!!}
            <p class="text-danger">{{$errors->first('package_id')}}</p>
        </div>
        <div class="form-group required">
            {!! Form::label('published',trans('common.published') ,['class'=>' control-label']) !!}
                {!! Form::select('published', ['yes' => trans('common.yes'), 'no' => trans('common.no')],null, ['id' => 'published', "required", 'class' =>'form-control',]) !!}
                <p class="text-danger" id="name">{{$errors->first('published')}}</p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group required">
            {!! Form::label('code',trans('common.coupon').' '. trans('common.code') ,['class'=>' control-label']) !!}
                {!! Form::text('code', isset($couponInfo) ? null : rand(1000, 10000), ['id' => 'code', "required", 'class' =>'form-control','placeholder' => trans('common.coupon').' '. trans('common.code')]) !!}
                <p class="text-danger" id="name">{{$errors->first('code')}}</p>
        </div>
        <div class="form-group required col-md-6">
            {!! Form::label('discount_amount',trans('common.discount_amount') ,['class'=>' control-label']) !!}
                {!! Form::text('discount_amount',null, ['id' => 'discount_amount', "required", 'class' =>'form-control','placeholder' => trans('common.discount_amount')]) !!}
                <p class="text-danger" id="name">{{$errors->first('discount_amount')}}</p>
        </div>
        <div class="form-group required col-md-6">
            {!! Form::label('','',['class'=>' control-label']) !!}
                {!! Form::select('amount_type', $amount_types, null, ['id' => 'amount_type', "required", 'class' =>'form-control']) !!}
                <p class="text-danger" id="name">{{$errors->first('amount_type')}}</p>
        </div>
    </div>

    <div class="form-group required">
        {!! Form::label(null,null,['class'=>' col-md-3 control-label']) !!}
        <div class="col-md-7">
            {!! Form::submit($submit_button,['class' => 'btn btn-primary', 'id' => 'submit_btn', 'onclick' => 'submit_form(event)'])!!}
        </div>
    </div>

</div>

@if(isset($couponInfo))
<script>
    $(function() {
        $('#select_package').select2('val', 
            $.parseJSON('{!! $couponInfo->package_id !!}')
        );
    });
</script>    
@endif

