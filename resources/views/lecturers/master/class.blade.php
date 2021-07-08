@extends('layouts.main')
@section('side_bar')
    @include('lecturers.master.layouts.side_bar')
@endsection
@section('content')
    <header class="page-header">
        <h2>Manage Classes</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/master/home">
                        <i class="fa fa-dashboard"></i>
                    </a>
                </li>
                <li><span>Table Classes</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <section class="panel">

        <div class="panel-body">
            <a class="mb-xs mt-xs mr-xs modal-basic btn btn-primary addition" href="#modalForm" ><i class="fa fa-plus"></i>
                Add</a>
            <form action="/master/class/import" method="POST" enctype="multipart/form-data" id="importForm">
                @csrf
                <input type="file" id="myFile" name='file' style="display: none;">
                <button type="button" id="browse" class="mb-xs mt-xs mr-xs btn btn-primary addition pull-right"><i
                        class="fa fa-upload" onclick=""></i> Import</button>
                <a class="mb-xs mt-xs mr-xs btn btn-primary addition pull-right" href="/master/class/export"><i
                        class="fa fa-download"></i> Export</a>
            </form>
            <br>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">

                <thead>
                    <tr style="background-color :#34495e; color:white;">
                        <th>#</th>
                        <th>Class Name</th>
                        <th>Class Size</th>
                        <th>Department Name</th>
                        <th>Action</th>
                    </tr>
                </thead>


                <tbody id="data_table">
                    @foreach ($classes as $class)
                        <tr>
                            <td>{{ $class->id }}</td>
                            <td>{{ $class->class_name }}</td>
                            <td>{{ $class->class_size }}</td>
                            <td>{{ $class->dept_name }}</td>
                            <td class="actions">
                                {{-- <a href=""><i class="fa fa-eye"></i></a> --}}
                                <a href="#edit-modal" onclick="initEditModel({{ $class->id }})" class="modal-basic"><i
                                        class="fa fa-pencil text-primary"></i></a>
                                <a href="#" onclick="deleteClass({{ $class->id }})" class="delete-row"><i
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
                <h2 class="panel-title">Add Class</h2>
            </header>
            <form method="POST" action="/master/class/create" id="classForm" class="form-horizontal mb-lg"
                novalidate="novalidate">
                <div class="panel-body panel-body-nopadding classForm">
                    @csrf
                    <br>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Academic Year</label>
                        <div class="col-sm-9">
                            <select name="academic_year_id" class="form-control">
                                <option value="">--Select---</option>
                                @foreach ($academic_year as $academic_year)
                                    <option value="{{ $academic_year->id }}">{{ $academic_year->year_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text dept_name_error"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Academic Level</label>
                        <div class="col-sm-9">
                            <select name="academic_level_id" class="form-control">
                                <option value="">--Select---</option>
                                @foreach ($academic_level as $academic_level)
                                    <option value="{{ $academic_level->id }}">{{ $academic_level->academic_level_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text dept_name_error"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Class Size</label>
                        <div class="col-sm-9">
                            <input type="number" name="class_size" class="form-control" required />
                            <span class="text-danger error-text class_size_error"></span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Department</label>

                        <div class="col-sm-9">
                            <select name="dept_id" class="form-control">
                                <option value="">--Select---</option>
                                @foreach ($depts as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text dept_name_error"></span>
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Class Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="class_name" class="form-control" disabled />
                            <span class="text-danger error-text class_name_error"></span>
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
                <h2 class="panel-title">Edit Class</h2>
            </header>
            <form method="POST" id="editClassForm" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="panel-body panel-body-nopadding classForm">
                    @csrf
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Class Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="class_name" id="edit-class-name" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Class Size</label>
                        <div class="col-sm-9">
                            <input type="number" name="class_size" id="edit-class-size" class="form-control" required />
                        </div>
                    </div>
                    <input type="text" style="display: none" id="edit-class-id">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Department</label>
                        <div class="col-sm-9">
                            <select name="dept_id" id="edit-dept-id" class="form-control">
                                <option value="">--Select---</option>
                                @foreach ($depts as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
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
            $('#classForm').on('submit', function(e) {
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
            $('#editClassForm').on('submit', function(e) {
                e.preventDefault();
                let class_id = $("#edit-class-id").val();
                $.ajax({
                    url: '/master/classes/edit/'+class_id,
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

        function deleteClass(id) {
            $.ajax({
                url: '/master/class/delete/'+id,
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

            $.get('/master/ajax/classes/'+id, function(response) {
                console.log(response);
                $("#edit-class-name").val(response.class.class_name);
                $("#edit-class-size").val(response.class.class_size);
                $("#edit-dept-id").val(response.class.dept_id);
                $("#edit-class-id").val(response.class.id);
            });
        }

        $(document).ready(function(){
            $('#browse').click(function(){
            $('#myFile').click();
        });
        $('#myFile').change(function(e) {
            $("#importForm").submit();
        })
        });
    </script>
@endsection
