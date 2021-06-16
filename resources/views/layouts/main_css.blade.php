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
    <link rel="stylesheet" href="{{ asset('assets/vendor/pnotify/pnotify.custom.css') }}" />

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
            body .btn-primary:hover {
            border-color: #34495e !important;
            background-color: #34495e !important;
        }
            .col-12 .btn-primary {
            border-color: #34495e !important;
            background-color: #34495e !important;
            width: 350px;
        }
    
            .addition {
            background-color: #34495e !important;
            border-color: #34495e !important;
        }
            .panel-heading {
            background-color: #34495e !important;
        }
            .panel-title{
                color:#ffffff;
        }
            #classForm{
                padding-right: 30px;
            }
        

    </style>
    <!-- Head Libs -->
    <script src="{{ asset('assets/vendor/modernizr/modernizr.js') }}"></script>
    @yield('assets')