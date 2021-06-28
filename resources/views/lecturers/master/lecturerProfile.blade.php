@extends('layouts.main')
@section('side_bar')
    @include('lecturers.master.layouts.side_bar')
@endsection
@section('content')
    <header class="page-header">
        <h2>Dashboard</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/master/home">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Show Lecturer</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-4 col-lg-3">

            <section class="panel">
                <div class="panel-body">
                    <div class="thumb-info mb-md">
                        <img src="{{ asset($lecturer->image) }}" class="rounded img-responsive" alt="John Doe">
                        <div class="thumb-info-title">
                            <span
                                class="thumb-info-inner">{{ $lecturer->first_name . ' ' . $lecturer->middle_name . ' ' . $lecturer->last_name }}</span>
                            <span class="thumb-info-type">{{ $lecturer->login_id }}</span>
                        </div>
                    </div>

                    <div class="widget-toggle-expand mb-md">
                        <div class="widget-header">
                            <h6>Personal Information</h6>
                            <div class="widget-toggle">+</div>
                        </div>
                        <div class="widget-content-collapsed">
                            <div class="progress progress-xs light">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 60%;">
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-expanded">
                            <ul class="simple-todo-list">
                                <li><strong>Email : </strong>{{ $lecturer->email }}</li>
                                <hr>
                                <li><strong>Phone no : </strong>{{ $lecturer->phone_no }}</li>
                                <hr>
                                <li><strong>Gender : </strong>{{ $lecturer->gender }}</li>
                                <hr>
                                <li><strong>Date of birth : </strong>{{ $lecturer->dob }}</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </section>

        </div>
        <div class="col-md-12 col-lg-9">

            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="active">
                        <a href="#module" data-toggle="tab">Lecturer's Modules </a>
                    </li>
                    <li>
                        <a href="#classes" data-toggle="tab">Lecturer's Classes</a>
                    </li>
                    @if ($lecturer->user_id == auth::user()->id)
                    <li>
                        <a href="#overview" data-toggle="tab">Personal Information</a>
                    </li>
                    <li>
                        <a href="#edit" data-toggle="tab">Change Password</a>
                    </li>
                    @endif
                   
                </ul>
                <div class="tab-content">
                    <div id="module" class="tab-pane active">
                        <h4 class="mb-xlg"><strong>Lecturer's Module </strong></h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped mb-none" id="modules-table">
                                        <thead>
                                            <tr style="background-color :#34495e; color:white;">
                                                <th>Subject Code</th>
                                                <th>Subject Name</th>
                                                <th>Subject Credit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subjects as $subject)
                                                <tr>
                                                    <td>{{ $subject->subject_code }}</td>
                                                    <td>{{ $subject->subject_name }}</td>
                                                    <td>{{ $subject->credit_no }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="classes" class="tab-pane">
                        <h4 class="mb-xlg"><strong>Lecturer's Classes</strong></h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped mb-none" id="classes-table">
                                        <thead>
                                            <tr style="background-color :#34495e; color:white;">
                                                <th>Class Name</th>
                                                <th>Department Name</th>
                                                <th>Class Size</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($classes as $classes)
                                                <tr>
                                                    <td>{{ $classes->class_name }}</td>
                                                    <td>{{ $classes->dept_name }}</td>
                                                    <td>{{ $classes->class_size }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($lecturer->user_id == auth::user()->id)
                    <div id="overview" class="tab-pane ">

                        <form class="form-horizontal" method="POST"
                            action="/master/profile/update/{{ $lecturer->user_id }}" id="UserForm">
                            @csrf
                            <h4 class="mb-xlg">Personal Information</h4>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileFirstName">First Name</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ $lecturer->first_name }}" class="form-control"
                                            name="first_name">
                                    </div>
                                </div>
                                <span class="text-danger error-text first_name_error"></span>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileFirstName">Middle Name</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ $lecturer->middle_name }}" class="form-control"
                                            name="middle_name">
                                    </div>
                                </div>
                                <span class="text-danger error-text middle_name_error"></span>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileLastName">Last Name</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ $lecturer->last_name }}" class="form-control"
                                            name="last_name">
                                    </div>
                                </div>
                                <span class="text-danger error-text last_name_error"></span>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileAddress">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" value="{{ $lecturer->email }}" class="form-control"
                                            name="email">
                                    </div>
                                </div>
                                <span class="text-danger error-text email_error"></span>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileCompany">Phone Number</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ $lecturer->phone_no }}" class="form-control"
                                            name="phone_no">
                                    </div>
                                </div>
                                <span class="text-danger error-text phone_no_error"></span>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileCompany">Date of birth</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ $lecturer->dob }}" class="form-control" name="dob">
                                    </div>
                                </div>
                                <span class="text-danger error-text dob_error"></span>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileCompany">Gender</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ $lecturer->gender }}" class="form-control"
                                            id="gender" name="gender">
                                    </div>
                                </div>
                                <span class="text-danger error-text gender_error"></span>

                            </fieldset>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="edit" class="tab-pane">
                        <form class="form-horizontal" action="/master/change-psw" method="POST" id="changePasswordForm">
                            @csrf
                            <h4 class="mb-xlg">Change Password</h4>
                            <fieldset class="mb-xl">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileOldPassword">Old Password</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="oldPassword" id="profileOldPassword">
                                        <span class="text-danger error-text oldPassword_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileNewPassword">New Password</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="newPassword" id="profileNewPassword">
                                        <span class="text-danger error-text newPassword_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileNewPasswordRepeat">Repeat New
                                        Password</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="repeatPassword" id="profileNewPasswordRepeat">
                                        <span class="text-danger error-text repeatPassword_error"></span>                                       
                                    </div>
                                </div>
                            </fieldset>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>

    </div><!-- end: page -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#modules-table').dataTable();
        });
        $(document).ready(function() {
            $('#classes-table').dataTable();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            $('#UserForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
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
        $('#changePasswordForm').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
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
    </script>
@endsection
