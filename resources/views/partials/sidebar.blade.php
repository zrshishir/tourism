<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                @if (Auth::check() && (isset(Auth::user()->photo)) && (Auth::user()->photo != ''))
                    @if(strpos(Auth::user()->photo, 'http') !== false)
                        <img src="{{ Auth::user()->photo }}" style="height: 45px; width: 45px;" class="img-circle"
                             alt="User Image"/>
                    @else
                        <img src="{{ url('upload/'.Auth::user()->photo) }}" style="height: 45px; width: 45px;"
                             class="img-circle" alt="User Image"/>
                    @endif
                @else
                    <img src={{ url('img/user2-160x160.jpg') }} class="img-circle" alt="User Image"/>
                @endif
            </div>
            <div class="pull-left info">
                @if(Auth::check())
                    @if(Auth::check())
                        <p>{{ Auth::user()->name }}</p>
                    @else
                        <p>John Doe</p>
                    @endif
                <!-- Status -->
                    @if(Auth::check())
                        <a href="#"><i class="fa fa-circle text-success"></i> {!! trans('common.online') !!}</a>
                    @endif
                @endif
            </div>
        </div>
    <?php $url = Request::segment(1); ?>
    <!-- Sidebar Menu -->
        @if(Auth::user())
            <ul class="sidebar-menu">
                
                @if(Auth::check() && Auth::user()->role == 'superadmin')
                    <li class="{{ ($url == 'home' || $url == '')? "active" : ''}}"><a href="{{ url('home') }}"><i
                                class='fa fa-dashboard'></i> <span>{!! trans('common.Dashboard') !!}</span></a></li>
                    <li class="{{ ($url == 'users')? "active" : ''}}"><a href="{{ url('users') }}"><i
                                class='fa fa-users'></i> <span>{!! trans('common.users') !!}</span>
                    </a></li>
                    <li class="{{ ($url == 'apprequest')? "active" : ''}}"><a href="{{ url('apprequest') }}"><i
                                class='fa fa-paper-plane'></i> <span>{!! trans('common.request') !!}</span></a></li>
                            
                    <li class="{{ ($url == 'activities')? "active" : ''}}"><a href="{{ url('activities') }}"><i
                                class='fa fa-list-alt'></i> <span>{!! trans('common.Activities') !!}</span></a></li>
                @else
                <li class="{{ ($url == 'apprequest')? "active" : ''}}"><a href="{{ url('apprequest') }}"><i
                                class='fa fa-paper-plane'></i> <span>{!! trans('common.request') !!}</span></a></li>
                @endif
            
            </ul><!-- /.sidebar-menu -->
        @endif
    </section>
    <!-- /.sidebar -->
</aside>
