@extends('app')
@section('main-content')

<div class="row">
    
	<div class="col-md-12">
    <h2>{{ $title }}</h2>
               <table class="table table-bordered display" style="width:100%" id="emails">
                    <thead>
                   
                        @foreach($table_headings as $key=>$value)
                            <th>{{ $value }}</th>
                        @endforeach
                    </thead>
                    <tbody>
                    
                    </tbody>                		
               </table>
        </div>
</div>

<style>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
</style>
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
      var col = {!! $db_columns !!};

        $('#emails').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('sent-email-list') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}", email_history_id: "{{$email_history_id}}"}
                   },
            "columns": col
                
        });
    });

</script>
@endsection