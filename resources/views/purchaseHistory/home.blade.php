@extends('app')

@section('main-content')
    <style>
        .badge-success {
            background-color: #398439;
        }

        .badge-danger {
            background-color: #d43f3a;
        }
    </style>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title pull-left">{{ trans('common.purchase_history') }}</h3>
        </div>
        <div class="box-body">
            <table class="table table-hover" id="purchase_history_table">
                <thead>
                <tr class="active">
                    <th class="col-sm-1">#</th>
                    <th>{!! trans('common.email') !!}</th>
                    <th>{!! trans('common.package') . ' ' . trans('common.name') !!}</th>
                    <th>{!! trans('common.package') . ' ' . trans('common.validity') !!}</th>
                    <th>{!! trans('common.package') . ' ' . trans('common.limit') !!}</th>
                    <th>{!! trans('common.package') . ' ' . trans('common.price') !!}</th>
                    <th>{!! trans('common.activated_at') !!}</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th colspan="5" style="text-align:right">{{ trans('common.total_amount') }}</th>
                    <th colspan="2"></th>
                </tr>
                </tfoot>
                <tbody>
                <?php $total_amount = 0; ?>
                @foreach($purchaseHistories as $key => $purchaseHistory)
                    <?php $total_amount += $purchaseHistory->package_price; ?>
                    <tr>
                        <td>{!! $key+1 !!}</td>
                        <td>{{ \App\User::find($purchaseHistory->user_id)->email }}</td>
                        <td><span class="label label-default">{{ $purchaseHistory->package_name }}</span></td>
                        <td>
                            <span class="label label-default">{{ $purchaseHistory->package_validity. ' days' }}</span>
                        </td>
                        <td><span class="label label-default">{{ $purchaseHistory->package_limit }}</span></td>
                        <td>{{ '$'.$purchaseHistory->package_price }}</td>
                        <td><span class="label label-default" id='date_{{ $purchaseHistory->id }}'></span></td>
                    </tr>
                    <script type="text/javascript">
                        $("#date_" + '{{ $purchaseHistory->id}}' ).text(formatAMPM("{{ date('n/j/Y h:i:s A', strtotime($purchaseHistory->created_at)) . ' UTC'}}"));
                    </script>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var export_filename = '{{ request()->segment(1) }}';

            $('#purchase_history_table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Copy',
                        extend: 'copy',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    }, {
                        text: 'CSV',
                        extend: 'csvHtml5',
                        title: export_filename,
                        extension: '.csv',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    }, {
                        text: 'XLS',
                        extend: 'excelHtml5',
                        title: export_filename,
                        extension: '.xls',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    }, {
                        text: 'PDF',
                        extend: 'pdf',
                        title: export_filename,
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    }, {
                        text: 'Print',
                        extend: 'print',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    }
                ],
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        console.log(i);
                        return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                        i : 0;
                    };

                    // Total over all pages
                    total = api
                            .column(5)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                    // Total over this page
                    pageTotal = api
                            .column(5, {page: 'current'})
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                    // Update footer
                    $(api.column(5).footer()).html(
                            '$' + pageTotal + ' ( $' + total + ' total )'
                    );
                }
            });
        });   
    </script>

@endsection