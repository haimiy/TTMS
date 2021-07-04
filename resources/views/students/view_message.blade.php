@extends('layouts.main')
@section('side_bar')
    @include('students.layouts.side_bar')
@endsection
@section('content')
        <header class="page-header">
            <h2>Message</h2>

            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>message</span></li>
                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>

<!-- start: page -->
<div id="generateTimetable">

    <section class="panel">

        <div class="panel-body">

            <table class="table table-bordered table-striped mb-none" id="datatable-default">

                <thead>
                    <tr style="background-color :#34495e; color:white;"> 
                        <th>Message No</th>  
                        <th>Lecturer Name</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                
                </thead>
                <tbody>
                   @foreach ($showReadMessage as $showReadMessage)
                   <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $showReadMessage->first_name. ' '.$showReadMessage->middle_name. ' '. $showReadMessage->last_name }}</td>
                    <td>{{ $showReadMessage->message}}</td>
                    <td>{{ date('d M Y - H:i', $showReadMessage->created_at) }}</td>
                   </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
 <!-- end: page -->
@endsection
@section('script')
//TODO: page script 
@endsection