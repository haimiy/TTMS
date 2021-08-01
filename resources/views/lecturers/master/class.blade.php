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
                        <th>Modules Name</th>
                        <th>Manage Modules</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="data_table">
                    
                    @foreach ($classes as $class)
                            @php
                              $subject_names = explode(",",$class->subject_names)  
                            @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $class->class_name }}</td>
                            <td>{{ $class->class_size }}</td>
                            <td>{{ $class->dept_name }}</td>
                            <td>
                                <ol>
                                 @foreach ($subject_names as $subject_name)
                                     <li>{{$subject_name}}</li>
                                 @endforeach
                                </ol>
                             </td>
                            <td class="actions center" >
                                <a class="text-primary modal-basic" onclick="initAddClassSubject('{{$class->class_name}}','{{$class->class_code}}')" href="#addModules" ><i class="fa fa-plus"></i>
                                </a>
                                <a href="#deleteModules" onclick="initDeleteClassSubject('{{$class->class_name}}','{{$class->class_code}}')"  class="text-danger modal-basic"><i class="fa fa-minus"></i></a>
                            </td>
                            <td class="actions center">
                                {{-- <a href=""><i class="fa fa-plus"></i></a> --}}
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
    <div id="addModules" class="modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <a href="#" class="fa fa-times modal-dismiss pull-right"></a>
                <h2 class="panel-title">Add Class Modules</h2>
            </header>
            <form method="POST" action="/master/class/add_module" id="addModuleForm" class="form-horizontal mb-lg"
                novalidate="novalidate">
                <div class="panel-body panel-body-nopadding classForm">
                    @csrf
                    <br>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Class Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="class_name" name="class_name"  class="form-control" required />
                            <input type="text" id="class_code" name="class_code"  class="form-control" style="display: none;" />
                            <span class="text-danger error-text class_name_error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Department</label>

                        <div class="col-sm-9">
                            <select id="dept_id" name="dept_id" class="form-control" onchange="getModules()">
                                <option value="">--Select---</option>
                                @foreach ($depts as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->dept_name }} ({{ $dept->dept_code }})</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text dept_name_error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Module Name</label>
                        <div class="col-sm-9">
                            <select id="subject_id" name="subject_id" class="form-control" onchange="getNtaLevels()">
                                <option value="">--Select---</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text subject_id_error"></span>
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
    <div id="deleteModules" class="modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <a href="#" class="fa fa-times modal-dismiss pull-right"></a>
                <h2 class="panel-title">Delete Class Modules</h2>
            </header>
            <form method="GET" action="/master/classes/classSubject" id="deleteModuleForm" class="form-horizontal mb-lg"
                novalidate="novalidate">
                <div class="panel-body panel-body-nopadding classForm">
                    @csrf
                    <br>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Class Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="class_name-add" name="class_name"  class="form-control" required />
                            <input type="text" id="class_code-add" name="class_code"  class="form-control" style="display: none;" />
                            <span class="text-danger error-text class_name_error"></span>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Module Name</label>
                        <div class="col-sm-9">
                            <select id="subject_id" name="subject_id" class="form-control" onchange="getNtaLevels()">
                                <option value="">--Select---</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text subject_id_error"></span>
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
                            <select id="academic_year_id" name="academic_year_id" class="form-control" onchange="generateClassName()">
                                <option value="">--Select---</option>
                                @foreach ($academic_years as $academic_year)
                                    <option value="{{ $academic_year->id }}">{{ $academic_year->year_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text dept_name_error"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Academic Level</label>
                        <div class="col-sm-9">
                            <select id="academic_level_id" name="academic_level_id" class="form-control" onchange="generateClassName()">
                                <option value="">--Select---</option>
                                @foreach ($academic_levels as $academic_level)
                                    <option value="{{ $academic_level->id }}">{{ $academic_level->academic_level_name }} ({{ $academic_level->academic_level_code }})</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text dept_name_error"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Class Size</label>
                        <div class="col-sm-9">
                            <input type="number" id="class_size" name="class_size" class="form-control" required onkeyup="generateClassName()"/>
                            <span class="text-danger error-text class_size_error"></span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Department</label>

                        <div class="col-sm-9">
                            <select id="dept_id" name="dept_id" class="form-control" onchange="getProgrammes()">
                                <option value="">--Select---</option>
                                @foreach ($depts as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->dept_name }} ({{ $dept->dept_code }})</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text dept_name_error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Programme</label>

                        <div class="col-sm-9">
                            <select id="programme_id" name="programme_id" class="form-control" onchange="generateClassName()">
                                <option value="">--Select---</option>
                               
                            </select>
                            <span class="text-danger error-text programme_id_error"></span>
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Class Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="class_name"  class="form-control" disabled />
                            <input type="text" id="class_name_val" name="class_name" class="form-control" style="display: none;" />
                            <span class="text-danger error-text class_name_error"></span>
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Class Code</label>
                        <div class="col-sm-9">
                            <input type="text" id="class_code"  class="form-control" disabled />
                            <input type="text" id="class_code_val" name="class_code" class="form-control" style="display: none;" />
                            <span class="text-danger error-text class_code_error"></span>
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
                    <br>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Academic Year</label>
                        <div class="col-sm-9">
                            <select id="academic_year_id" name="academic_year_id" class="form-control" onchange="editGenerateClassName()">
                                <option value="">--Select---</option>
                                @foreach ($academic_years as $academic_year)
                                    <option value="{{ $academic_year->id }}">{{ $academic_year->year_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text dept_name_error"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Academic Level</label>
                        <div class="col-sm-9">
                            <select id="academic_level_id" name="academic_level_id" class="form-control" onchange="editGenerateClassName()">
                                <option value="">--Select---</option>
                                @foreach ($academic_levels as $academic_level)
                                    <option value="{{ $academic_level->id }}">{{ $academic_level->academic_level_name }} ({{ $academic_level->academic_level_code }})</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text dept_name_error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Class Size</label>
                        <div class="col-sm-9">
                            <input type="number" name="class_size" id="class_size" class="form-control" required />
                        </div>
                    </div>
                    <input type="text" style="display: none" id="edit-class-id">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Department</label>

                        <div class="col-sm-9">
                            <select id="dept_id" name="dept_id" class="form-control" onchange="editGetProgrammes()">
                                <option value="">--Select---</option>
                                @foreach ($depts as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->dept_name }} ({{ $dept->dept_code }})</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text dept_name_error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Programme</label>

                        <div class="col-sm-9">
                            <select id="programme_id" name="programme_id" class="form-control" onchange="editGenerateClassName()">
                                <option value="">--Select---</option>   
                            </select>
                            <span class="text-danger error-text programme_id_error"></span>
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Class Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="class_name"  class="form-control" disabled />
                            <input type="text" id="class_name_val" name="class_name" class="form-control" style="display: none;" />
                            <span class="text-danger error-text class_name_error"></span>
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Class Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="class_code"  class="form-control" disabled />
                            <input type="text" id="class_code_val" name="class_code" class="form-control" style="display: none;" />
                            <span class="text-danger error-text class_code_error"></span>
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
                    },
                    error: function (e) {
                        console.log(e);
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
                        console.log(err);
                        new PNotify({
                            title: 'Error!',
                            text: "Something went wrong",
                            type: 'error',
                            addclass: 'icon-nb'
                        });
                    }
                });
            });
            $('#addModuleForm').on('submit', function(e) {
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
                            if (response.error){
                                $.each(response.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);

                                message += "<b># " + prefix + "</b> " + val + "\n";
                            });
                            }else{
                                message=response.message
                            }
                            
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
                                text: response.message,
                                type: 'success',
                                addclass: 'icon-nb'
                            });
                        }
                    },
                    error: function (e) {
                        console.log(e);
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
                $("#class_name").val(response.class.class_name);
                $("#class_size").val(response.class.class_size);
                $("#dept_id").val(response.class.dept_id);
                $("#academic_year_id").val(response.class.academic_year_id);
                $("#academic_level_id").val(response.class.academic_level_id);
                $("#programme_id").val(response.class.programme_id);
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
        function editGenerateClassName() {
            let year = $("#academic_year_id").val().trim();
            let level = $("#academic_level_id").val().trim();
            let dept_id = $("#dept_id").val().trim();
            let programme_id = $("#programme_id").val().trim();
            let class_size = $("#class_size").val().trim();
            let class_name="";
            let class_code="";
            $("#class_name").val(class_name);
            if (year.length>0 && level.length>0 && dept_id.length>0 && class_size.length>0 && programme_id.length>0){
                year = $("#academic_year_id option:selected").text().trim();
                level = $("#academic_level_id option:selected").text().trim();
                let dept_name = $("#dept_id option:selected").text().trim();
                let programme_name = $("#programme_id option:selected").text().trim();

                let class_level = level.split("(")[1].replace(")","");
                let class_year = year.split("/")[0].substr(2, 3);
                let class_dept = dept_name.split("(")[1].replace(")","");
                let class_programme = programme_name.split("(")[1].replace(")","");

                class_name = class_level+class_year+"-"+class_programme;
                class_code=class_name;
                let val = Math.ceil((class_size/40));
                if (val>1){
                    let cl="";
                    for (let i=1;val>=i;i++){
                        if (i==1)
                            cl = class_name+"-"+i;
                        else
                            cl+=","+class_name+"-"+i;
                    }
                    $("#class_name").val(cl);
                    $("#class_name_val").val(cl);
                }else {
                    $("#class_name").val(class_name);
                    $("#class_name_val").val(class_name);
                }
            }
            $("#class_code").val(class_code);
            $("#class_code_val").val(class_code);
        }
        function generateClassName() {
            let year = $("#academic_year_id").val().trim();
            let level = $("#academic_level_id").val().trim();
            let dept_id = $("#dept_id").val().trim();
            let programme_id = $("#programme_id").val().trim();
            let class_size = $("#class_size").val().trim();
            let class_name="";
            let class_code="";
            $("#class_name").val(class_name);
            if (year.length>0 && level.length>0 && dept_id.length>0 && class_size.length>0 && programme_id.length>0){
                year = $("#academic_year_id option:selected").text().trim();
                level = $("#academic_level_id option:selected").text().trim();
                let dept_name = $("#dept_id option:selected").text().trim();
                let programme_name = $("#programme_id option:selected").text().trim();

                let class_level = level.split("(")[1].replace(")","");
                let class_year = year.split("/")[0].substr(2, 3);
                let class_dept = dept_name.split("(")[1].replace(")","");
                let class_programme = programme_name.split("(")[1].replace(")","");

                class_name = class_level+class_year+"-"+class_programme;
                class_code= class_name;
                let val = Math.ceil((class_size/40));
                if (val>1){
                    let cl="";
                    for (let i=1;val>=i;i++){
                        if (i==1)
                            cl = class_name+"-"+i;
                        else
                            cl+=","+class_name+"-"+i;
                    }
                    $("#class_name").val(cl);
                    $("#class_name_val").val(cl);
                }else {
                    $("#class_name").val(class_name);
                    $("#class_name_val").val(class_name);
                }
            }
            $("#class_code").val(class_code);
            $("#class_code_val").val(class_code);
        }
        function getProgrammes(){
            let id = $("#dept_id").val().trim();
            if(id.length>0){
                $.ajax({
                    url: '/master/programme/select/'+id,
                    method: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    success: function(response) {
                        let html = '<option value="">--Select---</option>';
                        response.programmes.forEach(programme => {
                            html += '<option value="'+programme.id+'">'+programme.programme_name+' ('+programme.programme_code+')</option>'
                        });
                        $("#programme_id").html(html);
                    }
                });
            }
            
        }
        function getModules(){
            let id = $("#dept_id").val().trim();
            if(id.length>0){
                $.ajax({
                    url: '/master/subject/select/'+id,
                    method: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    success: function(response) {
                        let html = '<option value="">--Select---</option>';
                        response.subjects.forEach(subject => {
                            html += '<option value="'+subject.id+'">'+subject.subject_name+'</option>'
                        });
                        $("#subject_id").html(html);
                    }
                });
            }
            
        }
        function getNtaLevels(){
            let id = $("#subject_id").val().trim();
            if(id.length>0){
                $.ajax({
                    url: '/master/level/select/'+id,
                    method: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    success: function(response) {
                        let html = '<option value="">--Select---</option>';
                        response.academic_level.forEach(academic_level => {
                            html += '<option value="'+academic_level.id+'">'+academic_level.academic_level_name+'</option>'
                        });
                        $("#academic_level_id").html(html);
                    }
                });
            }
            
        }
        function editGetProgrammes(){
            let id = $("#dept_id").val().trim();
            if(id.length>0){
                $.ajax({
                    url: '/master/programme/select/'+id,
                    method: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    success: function(response) {
                        let html = '<option value="">--Select---</option>';
                        response.programmes.forEach(programme => {
                            html += '<option value="'+programme.id+'">'+programme.programme_name+' ('+programme.programme_code+')</option>'
                        });
                        $("#programme_id").html(html);
                    }
                });
            }
            
        }

        function initAddClassSubject(className,classCode) {
            $("#class_code").val(classCode);
            $("#class_name").val(className);
        }

        function initDeleteClassSubject(className,classCode) {
            $("#class_code-add").val(classCode);
            $("#class_name-add").val(className);
        }
        function getClassesSubject(){
            let id = $("#class_id").val().trim();
            if(id.length>0){
                $.ajax({
                    url: 'master/classes/classSubject/'+id,
                    method: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    success: function(response) {
                        let html = '<option value="">--Select---</option>';
                        response.class_subjects.forEach(class_subject => {
                            html += '<option value="'+class_subject.id+'">'+class_subject.subject_name+'</option>'
                        });
                        $("#subject_id").html(html);
                    }
                });
            }
        }

    </script>
@endsection
