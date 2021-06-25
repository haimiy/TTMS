@extends('layouts.main')
@section('side_bar')
    @include('lecturers.master.layouts.side_bar')
@endsection
@section('content')
    <header class="page-header">
        <h2>Manage Lecturers</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/master/home">
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
                        <th>Lecturer Code</th>
                        <th>Department Name</th>
                        <th>Action</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($lecturers as $lecturer)
                        <tr>
                            <td>{{ $lecturer->id }}</td>
                            <td>{{ $lecturer->login_id }}</td>
                            <td>{{ $lecturer->dept_name }}</td>
                            <td class="actions">
                                <a href="/master/profile/{{$lecturer->user_id}}"><i class="fa fa-eye"></i></a>
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
    <div id="modalForm" class="modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <a href="#" class="fa fa-times modal-dismiss pull-right"></a>
                <h2 class="panel-title">Add Lecturer</h2>
            </header>
            <form method="POST" action="{{ route('add_lecturer') }}" id="lecturerForm" class="form-horizontal mb-lg"
                novalidate="novalidate">
                <div class="panel-body panel-body-nopadding classForm">
                    @csrf
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Lecturer Code</label>
                        <div class="col-sm-9">
                            <input type="text" name="login_id" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Module Name</label>

                        <div class="col-sm-9">
                            <select name="subject_name" class="form-control">
                                <option value="">--Select---</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <br>
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

    <div id="edit-modal" class="modal-block modal-block-primary mfp-hide ">
        <section class="panel">
            <header class="panel-heading">
                <a href="#" class="fa fa-times modal-dismiss pull-right"></a>
                <h2 class="panel-title">Edit Lecturer</h2>
            </header>
            <form method="POST" id="editLecturerForm" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="panel-body panel-body-nopadding classForm">
                    @csrf
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Lecturer Code</label>
                        <div class="col-sm-9">
                            <input type="text" name="login_id" id="edit-login-id" class="form-control" required />
                        </div>
                    </div>
                    <input type="text" style="display: none;" id="edit-lecturer-id">

                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Module Name</label>

                        <div class="col-sm-9">
                            <select name="subject_id" id="edit-subject-id" class="form-control">
                                <option value="">--Select---</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <br>
                </div>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">Edit</button>
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
                    url: '/master/lecturer/edit/'+lecturer_id,
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
                url: '/master/lecturer/delete/' + id,
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

            $.get('/master/ajax/lecturer/'+id, function(response) {
                console.log(response);
                $("#edit-login-id").val(response.lecturer.login_id);
                $("#edit-subject-id").val(response.lecturer.subject_id);
                $("#edit-lecturer-id").val(response.lecturer.id);
            });
        }

        function editLecturer() {
            let login_id = $("#edit-login-id").val();
            let subject_id = $("#edit-subject-id").val();

            $.post('/master/lecturer/edit/'+lecturer_id, {
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