@extends('layouts.main')
@section('side_bar')
    @include('lecturers.master.layouts.side_bar')
@endsection
@section('content')
<header class="page-header">
    <h2>Manage Timeslots</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="/master/home">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Table Timeslot</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
</header>
 <!-- start: page -->
 <section class="panel">

    <div class="panel-body">
        <a class="mb-xs mt-xs mr-xs modal-basic btn btn-primary addition" href="#modalForm"><i
                class="fa fa-plus"></i> Add</a>
                <form action="/master/slot/import" id="importForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="myFile" name='file' style="display: none;">
                    <button type="button" id="browse" class="mb-xs mt-xs mr-xs btn btn-primary addition pull-right"><i
                            class="fa fa-upload" onclick=""></i> Import</button>
                    <a class="mb-xs mt-xs mr-xs btn btn-primary addition pull-right" href="/master/slot/export"><i
                            class="fa fa-download"></i> Export</a>
                </form>
                <br>
        <table class="table table-bordered table-striped mb-none" id="datatable-default">

            <thead>
                <tr style="background-color :#34495e; color:white;">
                    <th>#</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Action</th>
                </tr>
            </thead>


            <tbody>
                @foreach ($slots as $slot)
                <tr>
                    <td>{{ $slot->id }}</td>
                    <td>{{ $slot->start_time }}</td>
                    <td>{{ $slot->end_time }}</td>
                    <td class="actions">
                        {{-- <a href=""><i class="fa fa-eye"></i></a> --}}
                        <a href="#edit-modal" onclick="initEditModel({{ $slot->id}})"  class="modal-basic"><i class="fa fa-pencil text-primary"></i></a>
                        <a href="#" onclick="deleteSlot({{ $slot->id}})"  class="delete-row"><i class="fa fa-trash-o text-danger"></i></a>
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
            <h2 class="panel-title">Add Slot</h2>
        </header>
        <form method="POST" action="/master/slot/create" id="slotForm" class="form-horizontal mb-lg" novalidate="novalidate">
        <div class="panel-body panel-body-nopadding slotForm">
                @csrf
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Start Time</label>
                    <div class="col-sm-9">
                        <input type="time" name="start_time" class="form-control" required/>
                        <span class="text-danger error-text start_time_error"></span>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">End Time</label>
                    <div class="col-sm-9">
                        <input type="time" name="end_time" class="form-control" required/>
                        <span class="text-danger error-text end_time_error"></span>

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
            <h2 class="panel-title">Edit slot</h2>
        </header>
        <form method="POST"  id="editSlotForm" class="form-horizontal mb-lg" novalidate="novalidate">
        <div class="panel-body panel-body-nopadding slotForm">
            @csrf
            <input type="text" id="edit-slot-id" style="display:none">
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Start Time</label>
                    <div class="col-sm-9">
                        <input type="time" name="start_time" id="edit-start-time" class="form-control"required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">End Time</label>
                    <div class="col-sm-9">
                        <input type="time" name="end_time" id="edit-end-time" class="form-control" required/>
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
        $('#slotForm').on('submit', function(e){
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
        $('#editSlotForm').on('submit', function(e){
            e.preventDefault();
            console.log("edit")
            let slot_id =$("#edit-slot-id").val();
            $.ajax({
                url:'/master/slot/edit/'+slot_id,
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

    function deleteSlot(id) {
        $.ajax({
            url: '/master/slot/delete/'+id,
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

        $.get('/master/ajax/slot/'+id,function (response) {
            console.log(response);
            $("#edit-start-time").val(response.slot.start_time);
            $("#edit-end-time").val(response.slot.end_time);
            $("#edit-slot-id").val(response.slot.id);
        });
    }
    function editslot(){
        let start_time = $("#edit-start-time").val();
        let end_time = $("#edit-end-time").val();

        $.post('/master/slot/edit/'+slot_id,{'start_time':start_time,'end_time':end_time,"_token": "{{ csrf_token() }}"},function (response) {
            if(response.status){
                new PNotify({
                    title: 'Updated!',
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
