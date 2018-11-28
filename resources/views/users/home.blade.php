@extends('app')

@section('main-content')
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li @if ((count($errors) > 0) || isset($userInfo) || count($allUsers) == 0) class="" @else class="active" @endif ><a href="#all_users"
                                                                                                  data-toggle="tab">All
                    Users</a></li>
                <li @if ((count($errors) > 0) || isset($userInfo) || count($allUsers) == 0) class="active" @else class="" @endif ><a href="#manage_users"
                                                                                                  data-toggle="tab">{{ $title }}</a>
                </li>
        </ul>
        <div class="tab-content no-padding">
            <!-- ************** general *************-->
            <div @if ((count($errors) > 0) || isset($userInfo) || count($allUsers) == 0) class="tab-pane" @else class="tab-pane active"
                 @endif id="all_users">

                <table class="table table-hover" id="users-table">
                    <thead>
                    <tr class="active">
                        <th class="col-sm-1">#</th>
                        <th >{!! trans('common.name') !!}</th>
                        <th>{!! trans('common.email') !!}</th>
                        <th>{!! trans('common.status') !!}</th>
                        @if(Auth::user()->role == 'superadmin')
                        <th>{!! trans('common.role') !!}</th>
                        @endif
                        <th>{!! trans('common.action') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($allUsers) > 0)
                        @foreach($allUsers as $key =>$user)
                            <tr>
                                <td><a href="" data-toggle="modal" data-target="#user_detail_{{ $user->id }}"
                                       data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('common.show_details') }}">{!! $key+1 !!}</a></td>
                                <td><i class="fa fa-{{ $user->platform }}"></i> <a href="" data-toggle="modal" data-target="#user_detail_{{ $user->id }}"
                                                                                   data-toggle="tooltip" data-placement="top"
                                                                                   title="{{ trans('common.show_details') }}">{!! $user->name !!}</a></td>
                                <td>{{ $user->email }}</td>
                                <td><span @if($user->status == 'Active') class="label label-success"
                                          @elseif($user->status == 'Banned') class="label label-danger"
                                          @endif> <a style="color: white;" href="{{ url("users/change_status/$user->id") }}">{{ $user->status }}</a> </span>
                                </td>
                               
                                    <td>
                                      {{ $user->role}}
                                    </td>
                               
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'class' => 'delete-form']) !!}
                                    @if($user->status == 'Active')
                                        {!! btn_banned(url("users/change_status/$user->id")) !!}
                                    @elseif($user->status == 'Banned')
                                        {!! btn_active(url("users/change_status/$user->id")) !!}
                                    @endif
                                        {!! btn_edit("users/$user->id/edit") !!}
                                        @if($user->role != 'superadmin')
                                        {!! btn_delete_submit('All activities and informations will be deleted according to this user. You will not be able to recover this !!') !!}
                                        @endif
                                    {!! Form::close() !!}
                                </td>
                            </tr>

                            <div class="modal fade" id="user_detail_{{ $user->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                        aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"
                                                id="myModalLabel">{{ trans('common.user'). ' ' .trans('common.detail')}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-3 control-label text-right">{!! trans('common.name') !!}
                                                    :</label>

                                                <div class="col-sm-9">
                                                    <div class="form-control-static">
                                                        {{ $user->name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-3 control-label text-right">{!! trans('common.email') !!}
                                                    :</label>

                                                <div class="col-sm-9">
                                                    <div class="form-control-static">
                                                        {{ $user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-3 control-label text-right">{!! trans('common.package') !!}
                                                    :</label>

                                                <div class="col-sm-9">
                                                    <div class="form-control-static">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-3 control-label text-right">{!! trans('common.remaining_email') !!}
                                                    :</label>

                                                <div class="col-sm-9">
                                                    <div class="form-control-static">
                                                        <span class="label label-default">{{ $user->email_limit }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-3 control-label text-right">{!! trans('common.validity') !!}
                                                    :</label>

                                                <div class="col-sm-9">
                                                    <div class="form-control-static">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-3 control-label text-right">{!! trans('common.role') !!}
                                                    :</label>

                                                <div class="col-sm-9">
                                                    <div class="form-control-static">
                                                        @if($user->role == 'superadmin')
                                                            <span class="label label-warning">{{ trans('common.admin') }}</span>
                                                        @else
                                                            <span class="label label-info">{{ trans('common.user') }}</span>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-3 control-label text-right">{!! trans('common.status') !!}
                                                    :</label>

                                                <div class="col-sm-9">
                                                    <div class="form-control-static">
                                                        @if($user->status == 'Active')
                                                            <span class="label label-success">{{ $user->status }}</span>
                                                        @else
                                                            <span class="label label-danger">{{ $user->status }}</span>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3"
                                                       class="col-sm-3 control-label text-right">{!! trans('common.create_at') !!}
                                                    :</label>

                                                <div class="col-sm-9">
                                                    <div class="form-control-static">
                                                        <span class="label label-danger">{{ $user->created_at }}</span>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-3 control-label text-right">{!! trans('common.photo') !!}
                                                    :</label>

                                                <div class="col-sm-9">
                                                    <div class="form-control-static">
                                                        <div class="fileinput-new thumbnail" style="width: 210px;">
                                                            @if (isset($user->photo) && ($user->photo != ''))
                                                                @if(strpos($user->photo, 'http') === false)
                                                                    {!! Html::image('upload/'.$user->photo) !!}
                                                                @else
                                                                    <img src="{{ $user->photo }}" alt="User Image"/>
                                                                @endif
                                                            @else
                                                                <img src="{{ url('img/default.png') }}"
                                                                     alt="No Photo">
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div @if ((count($errors) > 0) || isset($userInfo) || count($allUsers) == 0) class="tab-pane active" @else class="tab-pane"
                 @endif id="manage_users">
                @if( !isset($userInfo) )
                        {!! Form::open(['url' => "users",'id'=>'client','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                        @include('users._form',['submit_button' => 'Submit'])

                        {!! Form::close() !!}
                @else
                    {!! Form::model($userInfo,['method' =>'PUT', 'url' => ["users",$userInfo->id],'id'=>'users','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes', 'files' => true]) !!}

                    @include('users._form',['submit_button' => 'Update'])

                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

    <script>
        $(function(){
            @if((count($errors) > 0 && (old('customers_user'))) || (isset($userInfo) && ($userInfo->customer_id != superadmin('id') && $userInfo->customer_id != 0)))
                $('#select_customer_div').show();
            @endif

            @if((Auth::id() == superadmin('id')) && isset($userInfo) && ($userInfo->department_id_list != ''))
                $('#select_department').select2('val', $.parseJSON('{!! $userInfo->department_id_list !!}'));
            @endif
        });

        $('#customers_user').click(function() {
            if($('#customers_user').is(':checked')) {
                $('#select_customer_div').show('slow');
            } else {
                $('#select_customer_div').hide('slow');
            }
        });

        $('#customer_id').change(function(e){
            var superAdmin_id = '{{ superadmin('id') }}';
            if($(this).val() != superAdmin_id) {
                if($('#select_department_div').is(':visible')) {
                    $('#select_department_div').hide('slow');
                }
            } else {
                if(! $('#select_department_div').is(':visible')) {
                    $('#select_department_div').show('slow');
                }
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            var export_filename = '{{ request()->segment(1) }}';

            $('#users-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'PDF',
                        extend: 'pdf',
                        title: export_filename,
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0,1,2,3,4]
                        }
                    }
                ]
            });
        });   
    </script>
@endsection