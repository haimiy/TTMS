@extends('layouts.main')
@section('side_bar')
    @include('lecturers.master.layouts.side_bar')
@endsection
@section('content')
<header class="page-header">
    <h2>Advanced Tables</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Tables</span></li>
            <li><span>Advanced</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
</header>
 <!-- start: page -->
 <section class="panel">

    <div class="panel-body">
        <a class="mb-xs mt-xs mr-xs modal-basic btn btn-primary" href="#modalHeaderColorPrimary"><i
                class="fa fa-plus"></i> Add</a>

        <table class="table table-bordered table-striped mb-none" id="datatable-default">

            <thead>
                <tr style="background-color :#34495e; color:white;">
                    <th>#</th>
                    <th>Class Name</th>
                    <th>Class Size</th>
                    {{-- <th class="hidden-phone">Engine version</th>
                    <th class="hidden-phone">CSS grade</th> --}}
                    <th>Action</th>
                </tr>
            </thead>

            @foreach ($classes as $class)      
            <tbody>
                <tr>
                    <td>{{ $class->id }}</td>
                    <td>{{ $class->class_name }}</td>
                    <td>{{ $class->class_size }}</td>
                    <td class="actions">
                        <a href=""><i class="fa fa-eye"></i></a>
                        <a href=""><i class="fa fa-pencil"></i></a>
                        <a href="" class="delete-row"><i class="fa fa-trash-o"></i></a>
                    </td>
                 </tr>
            </tbody>
            @endforeach

        </table>
    </div>
</section>
<!-- end: page -->

<div id="modalHeaderColorPrimary" class="modal-block modal-header-color modal-block-primary mfp-hide">
    <section class="panel form-wizard" id="w1">
        <header class="panel-heading">
          
            <h2 class="panel-title">Add data</h2>
        </header>
        <div class="panel-body panel-body-nopadding">
            <div class="wizard-tabs">
                <ul class="wizard-steps">
                    <li class="active">
                        <a href="#w1-account" data-toggle="tab" class="text-center">
                            <span class="badge hidden-xs">1</span>
                            Account
                        </a>
                    </li>
                    <li>
                        <a href="#w1-profile" data-toggle="tab" class="text-center">
                            <span class="badge hidden-xs">2</span>
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="#w1-confirm" data-toggle="tab" class="text-center">
                            <span class="badge hidden-xs">3</span>
                            Confirm
                        </a>
                    </li>
                </ul>
            </div>
            <form class="form-horizontal" novalidate="novalidate">
                <div class="tab-content">
                    <div id="w1-account" class="tab-pane active">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="w1-username">Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="username" id="w1-username"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="w1-password">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control input-sm" name="password"
                                    id="w1-password" minlength="6" required>
                            </div>
                        </div>
                    </div>
                    <div id="w1-profile" class="tab-pane">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="w1-first-name">First Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="first-name"
                                    id="w1-first-name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="w1-last-name">Last Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="last-name" id="w1-last-name"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div id="w1-confirm" class="tab-pane">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="w1-email">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="email" id="w1-email"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <div class="checkbox-custom">
                                    <input type="checkbox" name="terms" id="w1-terms" required>
                                    <label for="w1-terms">I agree to the terms of service</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer">
            <ul class="pager">
                <li class="previous disabled">
                    <a><i class="fa fa-angle-left"></i> Previous</a>
                </li>
                <li class="finish hidden pull-right modal-confirm"">
                    <a>Finish</a>
                </li>
                <li class="next">
                    <a>Next <i class="fa fa-angle-right"></i></a>
                </li>
            </ul>
        </div>

    </section>
</div>
@endsection
@section('script')
<!-- Examples -->
<script src="{{ asset('assets/javascripts/tables/examples.datatables.default.js') }}"></script>
<script src="{{ asset('assets/javascripts/tables/examples.datatables.row.with.details.js') }}"></script>
<script src="{{ asset('assets/javascripts/tables/examples.datatables.tabletools.js') }}"></script>
<!-- Examples -->
<script src="{{ asset('assets/javascripts/ui-elements/examples.modals.js') }}"></script>
<!-- Examples -->
<script src="{{ asset('assets/javascripts/forms/examples.wizard.js') }}"></script>
@endsection