<header class="header">
    <div class="logo-container">
        <a href="../" class="logo">
            <img src="{{ asset('assets/images/logo1.jpg') }}" height="35" alt="logo" />
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
            data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">
        <form action="pages-search-results.html" class="search nav-form">
            <div class="input-group input-search">
                <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>

        <span class="separator"></span>

        <ul class="notifications">
        @if (auth::user()->role_id == 3)
        <li>
            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                <i class="fa fa-bell"></i>
                <span class="badge">   
                    {{ $count_msg }}
                </span>
            </a>

            <div class="dropdown-menu notification-menu">
                <div class="notification-title">
                    <span class="pull-right label label-default">{{ $count_msg }}</span>
                    Messages
                </div>
                <div class="content">
                    <ul>
                        @foreach ($notify as $notify)
                        <li>
                            <a href="/student/read_message" class="clearfix">
                                <div class="image">
                                    <i class="fa fa-envelope bg-primary"></i>
                                </div>
                                <span class="title">{{ $notify->message}}</span>
                                <span class="message">Just now</span>
                            </a>
                        </li>
                        @endforeach
                        @if ($count_msg == 0)
                        <li>
                            <a href="#" class="clearfix">
                                <div class="image">
                                    <i class="fa fa-envelope-open bg-danger"></i>
                                </div>
                                <span class="title text-danger">Sorry! No messages</span>
                            </a>
                        </li>
                        @endif
                    </ul>

                    <hr />
 
                </div>
            </div>
        </li>
        @endif
        </ul>

        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="{{ asset(Auth::user()->image) }}" alt="Joseph Doe" class="img-circle"
                        data-lock-picture="{{ asset('assets/images/!logged-user.jpg') }}" />
                </figure>
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
                    <span class="name">{{ Auth::user()->first_name . ' ' . Auth::user()->middle_name }}</span>
                    <span class="role">{{ Auth::user()->login_id }}</span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <li>
                        @if (auth()->user()->role->user_role_name == 'lecturer')
                            @if (auth()->user()->lecturer->lecturer_role->lecturer_role_name == 'coordinator')
                            <a role="menuitem" tabindex="-1" href="{{ '/coordinator/profile/'.auth()->user()->id }}">
                                <i class="fa fa-user"></i> My Profile
                                </a>
                            @elseif(auth()->user()->lecturer->lecturer_role->lecturer_role_name == "master")
                                <a role="menuitem" tabindex="-1" href="{{ '/master/profile/'.auth()->user()->id }}">
                                    <i class="fa fa-user"></i> My Profile
                                </a>
                            @elseif(auth()->user()->lecturer->lecturer_role->lecturer_role_name == "normal")
                                <a role="menuitem" tabindex="-1" href="{{ '/lecturer/profile/'.auth()->user()->id }}">
                                    <i class="fa fa-user"></i> My Profile
                                </a>
                            @else
                            <a role="menuitem" tabindex="-1" href="{{ '/lecturer/profile/'.auth()->user()->id }}">
                                    <i class="fa fa-user"></i> My Profile
                                </a>
                            @endif
                        @elseif(auth()->user()->role->user_role_name == "student")
                        <a role="menuitem" tabindex="-1" href="{{ '/student/profile/'.auth()->user()->id }}">
                                <i class="fa fa-user"></i> My Profile
                            </a>
                        @elseif(auth()->user()->role->user_role_name == "admin")
                            <a role="menuitem" tabindex="-1" href="{{ '/admin/profile' }}">
                                <i class="fa fa-user"></i>My Profile
                            </a>
                        @endif
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="/lock" data-lock-screen="false"><i
                                class="fa fa-lock"></i> Lock Screen</a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="/logout"><i class="fa fa-power-off"></i>
                            Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
