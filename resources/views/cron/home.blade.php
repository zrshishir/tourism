@extends('app')

@section('htmlheader_title')
    Home
    @endsection

@section('main-content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{!! trans('common.cron'). ' '. trans('common.settings') !!}</h3>
        </div>

        <div class="box-body">
          
            <div>
                <h3>Please select backgroud job type</h3>
            </div>
            {!! Form::open(['url' => "cron",'class'=>'', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes']) !!}
            
            <div class="radio">
              <label>
                <input class="cronClick" type="radio" name="QUEUE_DRIVER" id="database" value="database" {{ $queueDriver == 'database' ? 'checked' : ''}}>
                Cron job (Recommend)
              </label>
            </div>

            <div id="cron" style="{{ $queueDriver == 'database' ? '' : 'display:none' }}">
                <h4>
                @if( env('QUEUE_DRIVER') == 'database' && $cron->value != 1) 
                <span class="text-danger">Your cron job settings is incorrect, Please add this Cron job to your server</span>
                @endif

                @if( env('QUEUE_DRIVER') == 'database' && $cron->value == 1) 
                Great!! Got last response from your cronjob at <span id="lastUpdate" class="text-danger"></span> It means, your cronjob is working perfectly.
                @endif
                </h4>
           
                <pre>* * * * * {{ PHP_BINDIR }}/php {{ base_path() }}/artisan schedule:run >> /dev/null 2>&1</pre>
            </div>

            <div class="radio">
              <label>
                <input type="radio" class="cronClick" name="QUEUE_DRIVER" id="sync" value="sync" {{ $queueDriver == 'sync' ? 'checked' :'' }} >
                Asynchronous
              </label>
            </div>
            <br/>
            {!! Form::submit('update',['class' => 'btn btn-primary'])!!}
            {!! Form::close() !!}
        </div>
    </div>
<script type="text/javascript">
    $(function(){
        $('.cronClick').click(function(){
            var id = $(this).prop('id');
            if(id == 'database'){
                $('#cron').show();
                return;
            }
            $('#cron').hide();
        });
        $("#lastUpdate").text(formatAMPM("{{ date('n/j/Y h:i:s A', strtotime($cron->updated_at)) . ' UTC'}}"));
    });
            
   
</script>

@endsection