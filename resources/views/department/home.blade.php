@extends('app')

@section('main-content')

    <div class="box box-default" style="margin-top: 0px">
        <!-- Tabs within a box -->
        <div class="box-header with-border">
            <h3 class="box-title pull-left">
                {{ $pageName }}
            </h3>
            <a href="" onclick="new_deparment(event)"
               class="pull-right">{{ trans('common.new').' '.$pageName}}</a>
        </div>
        <div class="box-body">
            <table class="table table-hover" id="department-table">
                <thead>
                    <tr class="active">
                        <th class="col-sm-1">#</th>
                        <th>{{ trans('common.name') }}</th>
                       
                    </tr>
                </thead>
                <tbody>
                @foreach($departments as $key =>$department)
                    <tr>
                        <td>{!! $key+1 !!}</td>
                        <td>{{ $department->name }}</td>
                       
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="department_modal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="myModalLabel">{{ $pageName }}</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => "departments",'id'=>'department_form','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                    @include('department._form',['submit_button' => 'Submit'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var export_filename = '{{ request()->segment(1) }}';

            $('#department-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                     {
                        text: 'PDF',
                        extend: 'pdf',
                        title: export_filename,
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0,1,2,3]
                        }
                    }
                ]
            });
        });        

        
       
    </script>

@endsection