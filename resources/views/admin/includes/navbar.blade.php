<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <!-- Logo -->
            <?php $settings = \App\Setting::pluck('value','name')->toArray(); $logo = isset($settings['logo']) ? $settings['logo']:''; ?>

            <a class="logo" href="{{route("admin.dashboard")}}">
                    <!--This is dark logo icon--><img src="{{asset("uploads/$logo")}}" alt="home" class="dark-logo" width="100%" /><!--This is light logo icon--><img src="{{asset("uploads/$logo")}}" alt="home" class="light-logo" width="100%" />
                </a>
        </div>
        <!-- /Logo -->
        <!-- Search input and Toggle icon -->
        <ul class="nav navbar-top-links navbar-left">
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>

            <!-- /.Megamenu -->
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">

            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="{{asset('admin/plugins/images/users/user.png')}}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php $user = Auth::user();echo $user->name;?></b><span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-img"><img src="{{asset('admin/plugins/images/users/user.png')}}" alt="user" /></div>
                            <div class="u-text">
                                <h4>{{$user->name}}</h4>
                                <p class="text-muted">{{$user->email}}</p><a href="{{route('admin-profile',Auth::user()->id)}}" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    {{--<li><a href="{{route('home')}}" target="_blank"><i class="fa fa-eye"></i> Visit Site</a></li>--}}
                    {{--<li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>--}}
                    {{--<li><a href="#"><i class="ti-email"></i> Inbox</a></li>--}}
                    {{--<li role="separator" class="divider"></li>--}}
                    {{--<li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>--}}
                    <li role="separator" class="divider"></li>
                    <li><a href="{{url('admin/logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
