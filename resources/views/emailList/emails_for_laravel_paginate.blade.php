@extends('app')
@section('main-content')
<div class="row">
	<div class="col-md-12">
               <table class="table table-bordered" id="posts">
                    <thead>
                        @foreach($columns as $key=>$value)
                            <th>{{ $value }}</th>
                        @endforeach
                    </thead>
                                
                    <tbody>
                        @foreach($group as $key=>$va)
                        <tr>
                            <td>{{ $va->id }}</td>
                            <td>{{ $va->group_id }}</td>
                            <td>{{ $va->name }}</td>
                            <td>{{ $va->email }}</td>
                            <td>{{ $va->subscribed }}</td>
                            <td>{{ $va->free_email_check }}</td>
                            <td>{{ $va->free_email_value }}</td>
                            <td>{{ $va->bulk_check }}</td>
                            <td>{{ $va->bulk_value }}</td>
                            <td>{{ $va->email_list_check }}</td>
                            <td>{{ $va->email_list_value }}</td>
                            <td>{{ $va->created_at }}</td>
                            <td>{{ $va->updated_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>				
               </table>
        </div>
</div>
{{$group->links()}}
<style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
</style>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#posts').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('allemails') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "name" },
                { "data": "email" },
                { "data": "subscribed" },
                { "data": "free_email_check" },
                { "data": "free_email_value" }
                { "data": "bulk_check" }
                { "data": "bulk_value" }
                { "data": "email_list_check" }
                { "data": "email_list_value" }
                { "data": "created_at" }
            ]	 

        });
@endsection