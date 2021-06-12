<!doctype html>
<html class="fixed">

<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title>Dashboard | JSOFT Themes | JSOFT-Admin</title>
    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
    <meta name="author" content="JSOFT.net">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"
        rel="stylesheet" type="text/css">


    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/morris/morris.css') }}" />

    <!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/style.css') }}" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/skins/default.css') }}" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/theme-custom.css') }}">
    <style>
        .content-body {
            padding: 3 40px;
        }
        .thumb-info .thumb-info-title {
            background: #34495e;
        }

    </style>
    <!-- Head Libs -->
    <script src="{{ asset('assets/vendor/modernizr/modernizr.js') }}"></script>

</head>

<body>
    <section class="body">

        <!-- start: header -->
        <header class="header">
            <div class="logo-container">
                <a href="../" class="logo">
                    <img src="{{ asset('assets/images/logo2.png') }}" height="35" alt="JSOFT Admin" />
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
                    <li>
                        <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                            <i class="fa fa-tasks"></i>
                            <span class="badge">3</span>
                        </a>

                        <div class="dropdown-menu notification-menu large">
                            <div class="notification-title">
                                <span class="pull-right label label-default">3</span>
                                Tasks
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        <p class="clearfix mb-xs">
                                            <span class="message pull-left">Generating Sales Report</span>
                                            <span class="message pull-right text-dark">60%</span>
                                        </p>
                                        <div class="progress progress-xs light">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="60"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                        </div>
                                    </li>

                                    <li>
                                        <p class="clearfix mb-xs">
                                            <span class="message pull-left">Importing Contacts</span>
                                            <span class="message pull-right text-dark">98%</span>
                                        </p>
                                        <div class="progress progress-xs light">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="98"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                                        </div>
                                    </li>

                                    <li>
                                        <p class="clearfix mb-xs">
                                            <span class="message pull-left">Uploading something big</span>
                                            <span class="message pull-right text-dark">33%</span>
                                        </p>
                                        <div class="progress progress-xs light mb-xs">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="33"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                            <i class="fa fa-envelope"></i>
                            <span class="badge">4</span>
                        </a>

                        <div class="dropdown-menu notification-menu">
                            <div class="notification-title">
                                <span class="pull-right label label-default">230</span>
                                Messages
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        <a href="#" class="clearfix">
                                            <figure class="image">
                                                <img src="{{ asset('assets/images/!sample-user.jpg') }}"
                                                    alt="Joseph Doe Junior" class="img-circle" />
                                            </figure>
                                            <span class="title">Joseph Doe</span>
                                            <span class="message">Lorem ipsum dolor sit.</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="clearfix">
                                            <figure class="image">
                                                <img src="{{ asset('assets/images/!sample-user.jpg') }}"
                                                    alt="Joseph Junior" class="img-circle" />
                                            </figure>
                                            <span class="title">Joseph Junior</span>
                                            <span class="message truncate">Truncated message. Lorem ipsum dolor sit
                                                amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin
                                                vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla
                                                molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec
                                                venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed
                                                interdum cursus dui nec venenatis. Pellentesque non nisi lobortis,
                                                rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet
                                                tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus
                                                tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo
                                                eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id.
                                                Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam
                                                tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur
                                                venenatis pharetra. Vestibulum egestas nisi quis elementum
                                                elementum.</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="clearfix">
                                            <figure class="image">
                                                <img src="{{ asset('assets/images/!sample-user.jpg') }}"
                                                    alt="Joe Junior" class="img-circle" />
                                            </figure>
                                            <span class="title">Joe Junior</span>
                                            <span class="message">Lorem ipsum dolor sit.</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="clearfix">
                                            <figure class="image">
                                                <img src="{{ asset('assets/images/!sample-user.jpg') }}"
                                                    alt="Joseph Junior" class="img-circle" />
                                            </figure>
                                            <span class="title">Joseph Junior</span>
                                            <span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non
                                                luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac
                                                tincidunt. Quisque eget convallis diam.</span>
                                        </a>
                                    </li>
                                </ul>

                                <hr />

                                <div class="text-right">
                                    <a href="#" class="view-more">View All</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <span class="badge">3</span>
                        </a>

                        <div class="dropdown-menu notification-menu">
                            <div class="notification-title">
                                <span class="pull-right label label-default">3</span>
                                Alerts
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        <a href="#" class="clearfix">
                                            <div class="image">
                                                <i class="fa fa-thumbs-down bg-danger"></i>
                                            </div>
                                            <span class="title">Server is Down!</span>
                                            <span class="message">Just now</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="clearfix">
                                            <div class="image">
                                                <i class="fa fa-lock bg-warning"></i>
                                            </div>
                                            <span class="title">User Locked</span>
                                            <span class="message">15 minutes ago</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="clearfix">
                                            <div class="image">
                                                <i class="fa fa-signal bg-success"></i>
                                            </div>
                                            <span class="title">Connection Restaured</span>
                                            <span class="message">10/10/2014</span>
                                        </a>
                                    </li>
                                </ul>

                                <hr />

                                <div class="text-right">
                                    <a href="#" class="view-more">View All</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <span class="separator"></span>

                <div id="userbox" class="userbox">
                    <a href="#" data-toggle="dropdown">
                        <figure class="profile-picture">
                            <img src="{{asset(Auth::user()->picture)}}" alt="Joseph Doe"
                                class="img-circle"
                                data-lock-picture="{{ asset('assets/images/!logged-user.jpg') }}" />
                        </figure>
                        <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
                            <span class="name">{{Auth::user()->first_name." ".Auth::user()->middle_name}}</span>
                            <span class="role">{{Auth::user()->login_id}}</span>
                        </div>

                        <i class="fa custom-caret"></i>
                    </a>

                    <div class="dropdown-menu">
                        <ul class="list-unstyled">
                            <li class="divider"></li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="{{ "/profile"}}"><i
                                        class="fa fa-user"></i> My Profile</a>
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
        <!-- end: header -->

        <div class="inner-wrapper">
            <!-- start: sidebar -->
            <aside id="sidebar-left" class="sidebar-left">

                <div class="sidebar-header">
                    <div class="sidebar-title">
                        Navigation
                    </div>
                    <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
                        data-fire-event="sidebar-left-toggle">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>

                <div class="nano">
                    <div class="nano-content">
                        <nav id="menu" class="nav-main" role="navigation">
                            <ul class="nav nav-main">
                                <li class="nav-active">
                                    <a href="/admin/home">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/class">
                                        <span class="pull-right label label-primary">182</span>
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <span>Classes</span>
                                    </a>
                                </li>
                                <li class="nav-parent">
                                    <a>
                                        <i class="fa fa-copy" aria-hidden="true"></i>
                                        <span>Modules</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="pages-signup.html">
                                                Sign Up
                                            </a>
                                        </li>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </aside>
            <!-- end: sidebar -->
            @yield('content')

            <aside id="sidebar-right" class="sidebar-right">
                <div class="nano">
                    <div class="nano-content">
                        <a href="#" class="mobile-close visible-xs">
                            Collapse <i class="fa fa-chevron-right"></i>
                        </a>

                        <div class="sidebar-right-wrapper">

                            <div class="sidebar-widget widget-calendar">
                                <h6>Upcoming Tasks</h6>
                                <div data-plugin-datepicker data-plugin-skin="dark"></div>

                                <ul>
                                    <li>
                                        <time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
                                        <span>Company Meeting</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="sidebar-widget widget-friends">
                                <h6>Friends</h6>
                                <ul>
                                    <li class="status-online">
                                        <figure class="profile-picture">
                                            <img src="{{ asset('assets/images/!sample-user.jpg') }}" alt="Joseph Doe"
                                                class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-online">
                                        <figure class="profile-picture">
                                            <img src="{{ asset('assets/images/!sample-user.jpg') }}" alt="Joseph Doe"
                                                class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-offline">
                                        <figure class="profile-picture">
                                            <img src="{{ asset('assets/images/!sample-user.jpg') }}" alt="Joseph Doe"
                                                class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-offline">
                                        <figure class="profile-picture">
                                            <img src="{{ asset('assets/images/!sample-user.jpg') }}" alt="Joseph Doe"
                                                class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </aside>
    </section>

    <!-- Vendor -->
    <script src="{{ asset('assets/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

    <!-- Specific Page Vendor -->
    <script src="{{ asset('assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-appear/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easypiechart/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('assets/vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/vendor/flot-tooltip/jquery.flot.tooltip.js') }}"></script>
    <script src="{{ asset('assets/vendor/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/vendor/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('assets/vendor/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-sparkline/jquery.sparkline.js') }}"></script>
    <script src="{{ asset('assets/vendor/raphael/raphael.js') }}"></script>
    <script src="{{ asset('assets/vendor/morris/morris.js') }}"></script>
    <script src="{{ asset('assets/vendor/gauge/gauge.js') }}"></script>
    <script src="{{ asset('assets/vendor/snap-svg/snap.svg.js') }}"></script>
    <script src="{{ asset('assets/vendor/liquid-meter/liquid.meter.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/jquery.vmap.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/data/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js') }}"></script>
    <!-- Specific Page Vendor -->
    <script src="{{ asset('assets/vendor/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}">
    </script>
    <script src="{{ asset('assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>
    <!-- Specific Page Vendor -->
    <script src="{{ asset('assets/vendor/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js') }}"></script>
    <script src="{{ asset('assets/vendor/pnotify/pnotify.custom.js') }}"></script>


    <!-- Theme Base, Components and Settings -->
    <script src="{{ asset('assets/javascripts/theme.js') }}"></script>

    <!-- Theme Custom -->
    <script src="{{ asset('assets/javascripts/theme.custom.js') }}"></script>

    <!-- Theme Initialization Files -->
    <script src="{{ asset('assets/javascripts/theme.init.js') }}"></script>
    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
        });
        $(function(){
            $('#UserForm').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    url:$(this).attr('action'),
                    method:$(this).attr('method'),
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.status == 0 ){
                            $.each(data.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            // $('#UserForm')[0].reset();
                            new PNotify({
                                title: 'Updated',
                                text: data.msg,
                                type: 'success',
                                addclass: 'icon-nb'
                            });
                        }
                    }
                });
            });
        });
    </script>

    @yield('script')

</html>