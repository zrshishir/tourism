<div class="form-group required">
    {!! Form::label('title',trans('common.title')) !!}
    {!! Form::text('title',null, ['id' => 'title', 'class' =>'form-control', 'required' => 'true']) !!}
    <p class="text-danger">{{$errors->first('title')}}</p>
</div>

<div class="form-group required">
    {!! Form::label('media',trans('common.media')) !!}

    <div class="col-md-12 col-md-offset-1">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 210px;" >
                @if (isset($medium) && ($medium->path != ''))
                    {!! Html::image('upload/'.$medium->path) !!}
                @else
                    <img src="http://placehold.it/350x260" alt="Please Connect Your Internet">
                @endif
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="width: 210px;" ></div>
            <div>
                <span class="btn btn-default btn-file">
                    <span class="fileinput-new">
                        <input type="file" name="media"  value="upload"  data-buttonText="<?= trans('choose_file') ?>" id="myImg" />
                        <span class="fileinput-exists">{!! trans('common.change') !!}</span>
                    </span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">{!! trans('common.remove') !!}</a>
                </span>
            </div>
            <p class="text-danger">{{$errors->first('media')}}</p>
            <p class="text-muted"><span class="badge"><i class="fa fa-question"></i></span> image only</p>
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::submit($submit_button,['class' => 'btn btn-sm btn-primary'])!!}
</div>