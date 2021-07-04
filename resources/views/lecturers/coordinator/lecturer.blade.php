@extends('layouts.main')
@section('side_bar')
    @include('lecturers.coordinator.layouts.side_bar')
@endsection
@section('content')
    <header class="page-header">
        <h2>Manage Lecturers</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/coordinator/home">
                        <i class="fa fa-dashboard"></i>
                    </a>
                </li>
                <li><span>Table Lecturers</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <section class="panel">

        <div class="panel-body">
            <a class="mb-xs mt-xs mr-xs modal-basic btn btn-primary addition" href="#modalForm"><i class="fa fa-plus"></i>
                Add</a>
            <a class="mb-xs mt-xs mr-xs btn btn-primary addition pull-right" href="#"><i class="fa fa-cloud-upload"></i>
                Import</a>

            <table class="table table-bordered table-striped mb-none" id="datatable-default">

                <thead>
                    <tr style="background-color :#34495e; color:white;">
                        <th>#</th>
                        <th>Lecturer Name</th>
                        <th>Department Name</th>
                        <th>Action</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($lecturers as $lecturer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lecturer->first_name.' '.$lecturer->middle_name.' '.$lecturer->last_name }}</td>
                            <td>{{ $lecturer->dept_name }}</td>
                            <td class="actions">
                                <a href="/coordinator/profile/{{$lecturer->user_id}}"><i class="fa fa-eye"></i></a>
                                <a href="#" onclick="deleteLecturer({{ $lecturer->id }})" class="delete-row"><i
                                class="fa fa-trash-o text-danger"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <!-- end: page -->

    <div id="modalForm" class="modal-block modal-block-lg mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <a href="#" class="fa fa-times modal-dismiss pull-right"></a>
                <h2 class="panel-title">Add Lecturer</h2>
            </header>
            <form method="POST" action="/coordinator/lecturer/create" id="lecturerForm">
                @csrf
                    <div class="panel-body" style="padding: 35px">
                        <div class="row">  
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>First Name</strong></label>
                                    <input type="text" class="form-control" name="first_name">
                                </div>
                                <span class="text-danger error-text first_name_error"></span>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>Middle Name</strong></label>
                                    <input type="text" class="form-control" name="middle_name">
                                </div>
                                <span class="text-danger error-text middle_name_error"></span>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>Last Name</strong></label>
                                    <input type="text" class="form-control" name="last_name">
                                </div>
                                <span class="text-danger error-text last_name_error"></span>
                            </div>
                        </div>

                        <div class="row">  
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>Email</strong></label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                                <span class="text-danger error-text email_error"></span>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>Phone Number</strong></label>
                                    <input type="text" class="form-control" name="phone_no">
                                </div>
                                <span class="text-danger error-text phone_no_error"></span>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>Lecturer Code</strong></label>
                                    <input type="text" class="form-control" name="login_id">
                                </div>
                                <span class="text-danger error-text login_id_error"></span>
                            </div>
                        </div>

                        <div class="row">  
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>Gender</strong></label>
                                    <select name="gender" class="form-control">
                                        <option value="">--Select---</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <span class="text-danger error-text gender_error"></span>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>Date of birth</strong></label>
                                    <input type="date" class="form-control" name="dob">
                                </div>
                                <span class="text-danger error-text dob_error"></span>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>Password</strong></label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <span class="text-danger error-text password_error"></span>
                            </div>
                        </div>

                        <div class="row">  
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>Department Name</strong></label>
                                    <select name="dept_id" class="form-control">
                                        <option value="">--Select---</option>
                                        @foreach ($depts as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger error-text dept_id_error"></span>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>Role Name</strong></label>
                                    <select name="lecturer_role_id" class="form-control">
                                        <option value="">--Select---</option>
                                        @foreach ($lecturerRoles as $lecturerRole)
                                            <option value="{{ $lecturerRole->id }}">{{ $lecturerRole->lecturer_role_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger error-text lecturer_role_id_error"></span>
                            </div>
                            
                        </div>
                    </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button id="close" class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </form>

        </section>
    </div>

@endsection
@section('script')
    <!-- Examples -->
    <script src="{{ asset('assets/javascripts/ui-elements/examples.modals.js') }}"></script>
    <!-- Examples -->
    <script src="{{ asset('assets/javascripts/forms/examples.wizard.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable-default').dataTable();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            $('#lecturerForm').on('submit', function(e) {
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
                    success: function(response) {
                        console.log(response);
                        if (response.status == 0) {
                            let message = '';
                            $.each(response.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);

                                message += "<b># " + prefix + "</b> " + val + "\n";
                            });
                            console.log(message)
                            new PNotify({
                                title: 'Error!',
                                text: message,
                                type: 'error',
                                addclass: 'icon-nb'
                            });
                        } else {
                            $("#close").click();
                            // $('#UserForm')[0].reset();
                            new PNotify({
                                title: 'Inserted',
                                text: response.msg,
                                type: 'success',
                                addclass: 'icon-nb'
                            });
                        }
                    }
                });
            });
            $('#editLecturerForm').on('submit', function(e) {
                e.preventDefault();
                console.log("edit")
                let lecturer_id = $("#edit-lecturer-id").val();
                $.ajax({
                    url: '/coordinator/lecturer/edit/'+lecturer_id,
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(response) {
                        if (response.status == 0) {
                            let message = '';
                            $.each(response.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);

                                message += "<b># " + prefix + "</b> " + val + "\n";
                            });
                            console.log(message)
                            new PNotify({
                                title: 'Error!',
                                text: message,
                                type: 'error',
                                addclass: 'icon-nb'
                            });
                        } else {
                            $("#close").click();
                            new PNotify({
                                title: 'Updated!',
                                text: response.message,
                                type: 'success',
                                addclass: 'icon-nb'
                            });
                        }
                    },
                    error: function(err) {
                        new PNotify({
                            title: 'Error!',
                            text: "Something went wrong",
                            type: 'error',
                            addclass: 'icon-nb'
                        });
                    }
                });
            });
        });

        function deleteLecturer(id) {
            $.ajax({
                url: '/coordinator/lecturer/delete/' + id,
                method: 'delete',
                success: function(response) {
                    if (response.status) {
                        new PNotify({
                            title: 'Deleted!',
                            text: response.message,
                            type: 'success',
                            addclass: 'icon-nb'
                        });
                    } else {
                        new PNotify({
                            title: 'Error!',
                            text: response.message,
                            type: 'error',
                            addclass: 'icon-nb'
                        });
                    }
                },

            });
        }

        function initEditModel(id) {

            $.get('/coordinator/ajax/lecturer/'+id, function(response) {
                console.log(response);
                $("#edit-login-id").val(response.lecturer.login_id);
                $("#edit-subject-id").val(response.lecturer.subject_id);
                $("#edit-lecturer-id").val(response.lecturer.id);
            });
        }

        function editLecturer() {
            let login_id = $("#edit-login-id").val();
            let subject_id = $("#edit-subject-id").val();

            $.post('/coordinator/lecturer/edit/'+lecturer_id, {
                'login_id': login_id,
                'subject_id': subject_id,
                "_token": "{{ csrf_token() }}"
            }, function(response) {
                if (response.status) {
                    new PNotify({
                        title: 'Updated!',
                        text: response.message,
                        type: 'success',
                        addclass: 'icon-nb'
                    });
                } else {
                    new PNotify({
                        title: 'Error!',
                        text: response.message,
                        type: 'error',
                        addclass: 'icon-nb'
                    });
                }
            });
        }

    </script>
@endsection
