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
        <a class="mb-xs mt-xs mr-xs modal-basic btn btn-primary addition" href="#modalForm"><i
                class="fa fa-plus"></i> Add</a>
        <a class="mb-xs mt-xs mr-xs btn btn-primary addition pull-right" href="#"><i
                    class="fa fa-cloud-upload"></i> Import</a>

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


            <tbody>
                @foreach ($classes as $class)
                <tr>
                    <td>{{ $class->id }}</td>
                    <td>{{ $class->class_name }}</td>
                    <td>{{ $class->class_size }}</td>
                    <td>{{ $class->dept_name }}</td>
                    <td class="actions">
                        <a href=""><i class="fa fa-eye"></i></a>
                        <a href="#edit-modal" onclick="initEditModel({{ $class->id}})"  class="modal-basic"><i class="fa fa-pencil text-primary"></i></a>
                        <a href="#" onclick="deleteClass({{ $class->id}})"  class="delete-row"><i class="fa fa-trash-o text-danger"></i></a>
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
        <form method="POST" action="{{ route('add_class')}}" id="classForm" class="form-horizontal mb-lg" novalidate="novalidate">
        <div class="panel-body panel-body-nopadding classForm">
                @csrf
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Class Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="class_name" class="form-control" placeholder="Type your name..." required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Class Size</label>
                    <div class="col-sm-9">
                        <input type="number" name="class_size" class="form-control" placeholder="Type your email..." required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Department</label>

                    <div class="col-sm-9">
                        <select name="dept_name" class="form-control">
                            <option value="">--Select---</option>
                            @foreach ( $depts as $dept )
                            <option  value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
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
                    <button  type="submit" class="btn btn-primary">Submit</button>
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
        <form method="POST" action="{{ route('editClass')}}" id="editClassForm" class="form-horizontal mb-lg" novalidate="novalidate">
        @csrf
        <div class="panel-body panel-body-nopadding classForm">
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Class Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="class_name" id="edit-class-name" class="form-control" placeholder="Type your name..." required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Class Size</label>
                    <div class="col-sm-9">
                        <input type="number" name="class_size" id="edit-class-size" class="form-control" placeholder="Type your email..." required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Department</label>

                    <div class="col-sm-9">
                        <select name="dept_name" id="edit-dept-id" class="form-control">
                            <option value="">--Select---</option>
                            @foreach ( $depts as $dept )
                                <option  value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
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
                    <button  type="submit" class="btn btn-primary" onclick="editClass()">Edit</button>
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
<!-- Examples -->
<script src="{{ asset('assets/javascripts/ui-elements/examples.modals.js') }}"></script>
<!-- Examples -->
<script src="{{ asset('assets/javascripts/forms/examples.wizard.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#datatable-default').dataTable();
    });
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
    });
    $(function(){
        $('#classForm').on('submit', function(e){
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
                        $("#close").click();
                        // $('#UserForm')[0].reset();
                        new PNotify({
                            title: 'Inserted',
                            text: data.msg,
                            type: 'success',
                            addclass: 'icon-nb'
                        });
                    }
                }
            });
        });
    });

    function deleteClass(id) {
        $.ajax({
            url: '/master/class/delete/'+id,
            method: 'delete',
            success:function (response) {
                if(response.status){
                    new PNotify({
                        title: 'Deleted!',
                        text: response.message,
                        type: 'success',
                        addclass: 'icon-nb'
                    });
                }else {
                    new PNotify({
                        title: 'Deleted!',
                        text: response.message,
                        type: 'error',
                        addclass: 'icon-nb'
                    });
                }
            },

        });
    }
    function initEditModel(id) {

        $.get('/master/ajax/classes/'+id,function (response) {
            console.log(response);
            $("#edit-class-name").val(response.class.class_name);
            $("#edit-class-size").val(response.class.class_size);
            $("#edit-dept-id").val(response.class.dept_id);
        });
    }
    function edi
    $(function(){
        $('#editClassForm').on('click', function(e){
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
                        $("#close").click();
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
@endsection
