@extends('layouts.main')
@section('side_bar')
    @include('lecturers.master.layouts.side_bar')
@endsection
@section('content')
<header class="page-header">
    <h2>Manage Venues</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="/master/home">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Tables Venues</span></li>
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
                    <th>Room Name</th>
                    <th>Room Size</th>
                    <th>Action</th>
                </tr>
            </thead>


            <tbody>
                @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->room_name }}</td>
                    <td>{{ $room->room_capacity }}</td>
                    <td class="actions">
                        {{-- <a href=""><i class="fa fa-eye"></i></a> --}}
                        <a href="#edit-modal" onclick="initEditModel({{ $room->id}})"  class="modal-basic"><i class="fa fa-pencil text-primary"></i></a>
                        <a href="#" onclick="deleteRoom({{ $room->id}})"  class="delete-row"><i class="fa fa-trash-o text-danger"></i></a>
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
            <h2 class="panel-title">Add Room</h2>
        </header>
        <form method="POST" action="{{ route('add_room')}}" id="roomForm" class="form-horizontal mb-lg" novalidate="novalidate">
        <div class="panel-body panel-body-nopadding roomForm">
                @csrf
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Room Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="room_name" class="form-control" required/>
                        <span class="text-danger error-text room_name_error"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Room Size</label>
                    <div class="col-sm-9">
                        <input type="number" name="room_capacity" class="form-control" required/>
                        <span class="text-danger error-text room_capacity_error"></span>
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
            <h2 class="panel-title">Edit Room</h2>
        </header>
        <form method="POST"  id="editroomForm" class="form-horizontal mb-lg" novalidate="novalidate">
        <div class="panel-body panel-body-nopadding roomForm">
            @csrf
            <input type="text" id="edit-room-id" style="display:none">
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Room Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="room_name" id="edit-room-name" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Room Size</label>
                    <div class="col-sm-9">
                        <input type="number" name="room_capacity" id="edit-room-capacity" class="form-control" required/>
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
        $('#roomForm').on('submit', function(e){
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
        $('#editroomForm').on('submit', function(e){
            e.preventDefault();
            console.log("edit")
            let room_id =$("#edit-room-id").val();
            $.ajax({
                url:'/master/room/edit/'+room_id,
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

    function deleteRoom(id) {
        $.ajax({
            url: '/master/room/delete/'+id,
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

        $.get('/master/ajax/room/'+id,function (response) {
            console.log(response);
            $("#edit-room-name").val(response.room.room_name);
            $("#edit-room-capacity").val(response.room.room_capacity);
            $("#edit-room-id").val(response.room.id);
        });
    }
    function editRoom(){
        let room_name = $("#edit-room-name").val();
        let room_capacity = $("#edit-room-capacity").val();

        $.post('/master/room/edit/'+room_id,{'room_name':room_name,'room_capacity':room_capacity,"_token": "{{ csrf_token() }}"},function (response) {
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
</script>
@endsection
