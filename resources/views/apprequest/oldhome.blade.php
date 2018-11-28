@extends('app')

@section('main-content')
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li class="active" ><a href="#all_users"
                                                                                                  data-toggle="tab">All
                    Requests</a></li>
             @if (Auth::user()->role == "user" )
                <li @if (Auth::user()->role == "user" && count($allRequests) == 0) class="active" @else class="" @endif ><a href="#manage_users"
                                                                                                  data-toggle="tab">Make Request</a>
                </li>
            @endif
            
        </ul>
        <div class="tab-content no-padding">
            <!-- ************** general *************-->
            <div  class="tab-pane active" 
                  id="all_users">

                <table class="table table-hover" id="users-table">
                    <thead>
                    <tr class="active">
                        <th class="col-sm-1">#</th>
                        <th >{!! trans('common.request') !!}</th>
                        <th>{!! trans('common.status') !!}</th>
                        @if(Auth::user()->role != 'user' && Auth::user()->role != 'superadmin')
                        <th>{!! trans('common.action') !!}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($allRequests) > 0)
                        @foreach($allRequests as $key =>$user)
                            <tr>
                            <td><a href="" data-toggle="modal" data-target="#user_detail_{{ $user->id }}"
                                       data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('common.show_details') }}">{!! $key+1 !!}</a></td>
                                <td>{{ $user->request }}</td>
                                <td><span @if($user->status == 0) class="label label-default"
                                          @elseif($user->status == 1) class="label label-primary"
                                          @elseif($user->status == 2) class="label label-success"
                                          @endif> <a style="color: white;" href="{{ url("apprequest/change_status/$user->id") }}">
                                          
                                          <?php 
                                            if($user->status == 0){
                                                echo "open";
                                            }else if($user->status == 1){
                                                echo "hr reviewed";
                                            }else if($user->status == 2){
                                                echo "processed";
                                            }
                                          ?>
                                          
                                          </a> </span>
                                </td>

                                @if(Auth::user()->role != 'user' && Auth::user()->role != 'superadmin')
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['apprequest.destroy', $user->id], 'class' => 'delete-form']) !!}
                                    
                                        {!! btn_banned(url("apprequest/change_status/$user->id")) !!}
        
                                    {!! Form::close() !!}
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            @if(Auth::user()->role == "user")
            <div @if ((count($errors) > 0) || isset($userInfo) || count($allRequests) == 0) class="tab-pane active" @else class="tab-pane"
                 @endif id="manage_users">
                @if( !isset($userInfo) )
                        {!! Form::open(['url' => "apprequest",'id'=>'client','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                        @include('apprequest._form',['submit_button' => 'Submit'])

                        {!! Form::close() !!}
                @else
                    {!! Form::model($userInfo,['method' =>'PUT', 'url' => ["apprequest",$userInfo->id],'id'=>'apprequest','class'=>'form-horizontal', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes', 'files' => true]) !!}

                    @include('apprequest._form',['submit_button' => 'Update'])

                    {!! Form::close() !!}
                @endif
            </div>
            @endif
        </div>
    </div>


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
                            columns: [0,1,2]
                        }
                    }
                ]
            });
        });   
    </script>
@endsection