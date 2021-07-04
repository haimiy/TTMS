@extends('layouts.main')
@section('side_bar')
    @include('lecturers.master.layouts.side_bar')
@endsection
@section('content')
        <header class="page-header">
            <h2>Notification</h2>

            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Notification</span></li>
                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>

<!-- start: page -->
<div class="row">
    <section class="panel">
        <div class="panel-body">
            <form method="POST" id="messageForm" action="/master/notify/send/message" class="form-horizontal">
                @csrf
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="profileFirstName"><strong>Enter a message</strong></label>
                            <div class="col-md-8">
                                <textarea rows="4" type="text" class="form-control" name="message"></textarea>
                            </div>
                        </div>
                        <span class="text-danger error-text message_error"></span>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="profileFirstName"><strong>Enter Class Name</strong></label>
                            <div class="col-md-8">
                            <select name="class_id" class="form-control">
                                <option value="">--Select---</option>
                                @foreach ($classes as $classes)
                                    <option value="{{ $classes->id }}">{{ $classes->class_name }}</option>
                                @endforeach
                            </select>
                            </div>                           
                        </div>
                        <span class="text-danger error-text class_id_error"></span>    
                    </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </footer>
            </form>
        </div>
    </section>

</div>
<!-- end: page -->
@endsection
@section('script')
<script>
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            $('#messageForm').on('submit', function(e) {
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
                            $('#messageForm')[0].reset();
                            new PNotify({
                                title: 'Sent',
                                text: response.msg,
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