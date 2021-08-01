@extends('layouts.main')
@section('side_bar')
    @include('lecturers.master.layouts.side_bar')
@endsection
@section('content')
<header class="page-header">
    <h2>Manage Blocks</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="/master/home">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Tables Blocks</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
</header>
 <!-- start: page -->
 <section class="panel">

    <div class="panel-body">
        <a class="mb-xs mt-xs mr-xs modal-basic btn btn-primary addition" href="#modalForm"><i
                class="fa fa-plus"></i> Add</a>
                <br>
        <table class="table table-bordered table-striped mb-none" id="datatable-default">

            <thead>
                <tr style="background-color :#34495e; color:white;">
                    <th>#</th>
                    <th>Block Name</th>
                    <th>Floor Count</th>
                    <th>Room Count</th>
                    <th>Action</th>
                </tr>
            </thead>


            <tbody>
                @foreach ($blocks as $block)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $block->block_name }}</td>
                    <td>{{ $block->t_floor }}</td>
                    <td>{{ $block->room_count }}</td>
                    <td class="actions">
                        {{-- <a href=""><i class="fa fa-eye"></i></a> --}}
                        <a href="#edit-modal" onclick="initEditModel({{ $block->id}})"  class="modal-basic"><i class="fa fa-pencil text-primary"></i></a>
                        <a href="#" onclick="deleteBlock({{ $block->id}})"  class="delete-row"><i class="fa fa-trash-o text-danger"></i></a>
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
            <h2 class="panel-title">Add block</h2>
        </header>
        <form method="POST" action="/master/block/create" id="blockForm" class="form-horizontal mb-lg" novalidate="novalidate">
        <div class="panel-body panel-body-nopadding blockForm">
                @csrf
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Block Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="block_name" class="form-control" required/>
                        <span class="text-danger error-text block_name_error"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Floor Count</label>
                    <div class="col-sm-9">
                        <input type="number" name="t_floor" class="form-control" required/>
                        <span class="text-danger error-text t_floor_error"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Room Count</label>
                    <div class="col-sm-9">
                        <input type="number" name="room_count" class="form-control" required/>
                        <span class="text-danger error-text room_count_error"></span>
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
            <h2 class="panel-title">Edit Block</h2>
        </header>
        <form method="POST"  id="editBlockForm" class="form-horizontal mb-lg" novalidate="novalidate">
        <div class="panel-body panel-body-nopadding blockForm">
            @csrf
            <input type="text" id="edit-block-id" style="display:none">
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Block Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="block_name" id="edit-block-name" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Floor Count</label>
                    <div class="col-sm-9">
                        <input type="number" name="t_floor" id="edit-t-floor" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Room Count</label>
                    <div class="col-sm-9">
                        <input type="number" name="room_count" id="edit-room-count" class="form-control" required/>
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
        $('#blockForm').on('submit', function(e){
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
        $('#editBlockForm').on('submit', function(e){
            e.preventDefault();
            console.log("edit")
            let block_id =$("#edit-block-id").val();
            $.ajax({
                url:'/master/block/edit/'+block_id,
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

    function deleteBlock(id) {
        $.ajax({
            url: '/master/block/delete/'+id,
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
        
        $.get('/master/ajax/block/'+id,function (response) {
            console.log(response);
            $("#edit-block-name").val(response.block.block_name);
            $("#edit-t-floor").val(response.block.t_floor);
            $("#edit-room-count").val(response.block.room_count);
            $("#edit-block-id").val(response.block.id);
        });
    }
    function editBlock(){
        let block_name = $("#edit-block-name").val();
        let t_floor = $("#edit-t-floor").val();
        let room_count = $("#edit-room-count").val();

        $.post('/master/block/edit/'+block_id,{'block_name':block_name,'t_floor':t_floor,'room_count':room_count,"_token": "{{ csrf_token() }}"},function (response) {
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
