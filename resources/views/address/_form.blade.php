<p>
	Under <a href='https://en.wikipedia.org/wiki/CAN-SPAM_Act_of_2003#Content_compliance' target="_blank">CAN-SPAM Act of 2003</a> you have to send your physical address at email footer. 
</p>
<p>
	If you don't want to send physical address, please remove the bellow addrees and click on 'Update' button.
</p>
{!! Form::textarea('address', $address, ['id' => 'editor1', 'class' =>'form-control', 'placeholder' => 'Enter'.' '.trans('common.address'),]) !!}

{{$errors->first('address')}}
 <br/>
{!! Form::submit('update',['class' => 'btn btn-primary'])!!}
