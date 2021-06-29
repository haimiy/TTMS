@extends('layouts.main')
@section('side_bar')
    @include('lecturers.master.layouts.side_bar')
@endsection
@section('content')
<header class="page-header">
    <h2>Manage Subjects</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="/master/home">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Table Subject</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
</header>
 <!-- start: page -->
 <section class="panel">

    <div class="panel-body">
        <a class="mb-xs mt-xs mr-xs modal-basic btn btn-primary addition" href="#modalForm"><i
                class="fa fa-plus"></i> Add</a>
                <form action="/master/subject/import" id="importForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="myFile" name='file' style="display: none;">
                    <button type="button" id="browse" class="mb-xs mt-xs mr-xs btn btn-primary addition pull-right"><i
                            class="fa fa-upload" onclick=""></i> Import</button>
                    <a class="mb-xs mt-xs mr-xs btn btn-primary addition pull-right" href="/master/subject/export"><i
                            class="fa fa-download"></i> Export</a>
                </form>
                <br>
        <table class="table table-bordered table-striped mb-none" id="datatable-default">

            <thead>
                <tr style="background-color :#34495e; color:white;">
                    <th>#</th>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Credit No</th>
                    <th>Action</th>
                </tr>
            </thead>


            <tbody>
                @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->subject_name }}</td>
                    <td>{{ $subject->subject_code }}</td>
                    <td>{{ $subject->credit_no }}</td>
                    <td class="actions">
                        {{-- <a href=""><i class="fa fa-eye"></i></a> --}}
                        <a href="#edit-modal" onclick="initEditModel({{ $subject->id}})"  class="modal-basic"><i class="fa fa-pencil text-primary"></i></a>
                        <a href="#" onclick="deleteSubject({{ $subject->id}})"  class="delete-row"><i class="fa fa-trash-o text-danger"></i></a>
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
            <h2 class="panel-title">Add Subject</h2>
        </header>
        <form method="POST" action="{{ route('add_subject')}}" id="subjectForm" class="form-horizontal mb-lg" novalidate="novalidate">
        <div class="panel-body panel-body-nopadding subjectForm">
                @csrf
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Subject Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="subject_name" class="form-control" required/>
                        <span class="text-danger error-text subject_name_error"></span>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Subject Code</label>
                    <div class="col-sm-9">
                        <input type="text" name="subject_code" class="form-control" required/>
                        <span class="text-danger error-text subject_code_error"></span>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Credit No</label>
                    <div class="col-sm-9">
                        <input type="number" name="credit_no" class="form-control" required/>
                        <span class="text-danger error-text credit_no_error"></span>

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
            <h2 class="panel-title">Edit Subject</h2>
        </header>
        <form method="POST"  id="editSubjectForm" class="form-horizontal mb-lg" novalidate="novalidate">
        <div class="panel-body panel-body-nopadding subjectForm">
            @csrf
            <input type="text" id="edit-subject-id" style="display:none;">
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Subject Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="subject_name" id="edit-subject-name" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Subject Code</label>
                    <div class="col-sm-9">
                        <input type="text" name="subject_code" id="edit-subject-code" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Credit No</label>
                    <div class="col-sm-9">
                        <input type="number" name="credit_no" id="edit-credit-no" class="form-control" required/>
                    </div>
                </div>
                <br>
                <br>
        </div>

        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button  type="submit" class="btn btn-primary" >Edit</button>
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
        $('#subjectForm').on('submit', function(e){
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
                success:function(response){
                    if(response.status == 0 ){
                        let message='';
                        $.each(response.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);

                            message += "<b># "+prefix+"</b> "+val+"\n";
                        });
                        console.log(message)
                        new PNotify({
                            title: 'Error!',
                            text: message,
                            type: 'error',
                            addclass: 'icon-nb'
                        });
                    }else{
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
        $('#editSubjectForm').on('submit', function(e){
            e.preventDefault();
            console.log("edit")
            let subject_id =$("#edit-subject-id").val();
            $.ajax({
                url:'/master/subject/edit/'+subject_id,
                method:$(this).attr('method'),
                data:new FormData(this),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success:function(response){
                    if(response.status == 0 ){
                        let message='';
                        $.each(response.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);

                            message += "<b># "+prefix+"</b> "+val+"\n";
                        });
                        console.log(message)
                        new PNotify({
                            title: 'Error!',
                            text: message,
                            type: 'error',
                            addclass: 'icon-nb'
                        });
                    }else{
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
                error:function (err) {
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

    function deleteSubject(id) {
        $.ajax({
            url: '/master/subject/delete/'+id,
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

        $.get('/master/ajax/subject/'+id,function (response) {
            console.log(response);
            $("#edit-subject-name").val(response.subject.subject_name);
            $("#edit-subject-code").val(response.subject.subject_code);
            $("#edit-credit-no").val(response.subject.credit_no);
            $("#edit-subject-id").val(response.subject.id);
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
