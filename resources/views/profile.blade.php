@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>User Profile</h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Pages</span></li>
                <li><span>User Profile</span></li>
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
                        <img src="{{ Auth::user()->picture}}" class="rounded img-responsive" alt="John Doe">
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner">{{Auth::user()->first_name." ".Auth::user()->middle_name}}</span>
                            <span class="thumb-info-type">{{Auth::user()->login_id}}</span>
                        </div>   
                    </div>
                    <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Change Picture</button>
                    </div>

                </div>
            </section>

        </div>
        <div class="col-md-12 col-lg-9">

            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="active">
                        <a href="#overview" data-toggle="tab">Personal Information</a>
                    </li>
                    <li>
                        <a href="#edit" data-toggle="tab">Change Password</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="overview" class="tab-pane active">
                        
                        <form class="form-horizontal" method="POST" action="{{ route('updateProfileUser')}}" id="UserForm">
                            @csrf
                            <h4 class="mb-xlg">Personal Information</h4>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileFirstName">First Name</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ Auth::user()->first_name}}" class="form-control" name="first_name">
                                    </div>
                                </div>
                                <span class="text-danger error-text first_name_error"></span>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileFirstName">Middle Name</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ Auth::user()->middle_name}}" class="form-control" name="middle_name">
                                    </div>
                                </div>
                                <span class="text-danger error-text middle_name_error"></span>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileLastName">Last Name</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ Auth::user()->last_name}}" class="form-control" name="last_name">
                                    </div>
                                </div>
                                <span class="text-danger error-text last_name_error"></span>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileAddress">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" value="{{ Auth::user()->email}}" class="form-control" name="email">
                                    </div>
                                </div>
                                <span class="text-danger error-text email_error"></span>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileCompany">Phone Number</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ Auth::user()->phone_no}}" class="form-control" name="phone_no">
                                    </div>
                                </div>
                                <span class="text-danger error-text phone_no_error"></span>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileCompany">Date of birth</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ Auth::user()->dob}}" class="form-control" name="dob">
                                    </div>
                                </div>
                                <span class="text-danger error-text dob_error"></span>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileCompany">Gender</label>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ Auth::user()->gender}}" class="form-control" name="gender">
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

                        <form class="form-horizontal" method="get">
                            <h4 class="mb-xlg">Change Password</h4>
                            <fieldset class="mb-xl">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileNewPassword">Old Password</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="profileNewPassword">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileNewPassword">New Password</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="profileNewPassword">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileNewPasswordRepeat">Repeat New Password</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="profileNewPasswordRepeat">
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
                </div>
            </div>
        </div>

    </div>
    <!-- end: page -->
</section>

@endsection