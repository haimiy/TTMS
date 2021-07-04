@extends('layouts.main')
@section('side_bar')
@include('lecturers.normal_lecturer.layouts.side_bar')
@endsection
@section('content')
        <header class="page-header">
            <h2>Dashboard</h2>

            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Dashboard</span></li>
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
                        <th>Day Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Subject Name</th>
                        <th>Class Name</th>
                        <th>Venue Name</th>
                    </tr>
                
                </thead>
                <tbody>
                   @foreach ($timetable as $timetable)
                   <tr>
                    <td>{{ $timetable->day_name}}</td>
                    <td>{{ $timetable->start_time}}</td>
                    <td>{{ $timetable->end_time}}</td>
                    <td>{{ $timetable->subject_name}}</td>
                    <td>{{ $timetable->class_name}}</td>
                    <td>{{ $timetable->room_name}}</td>
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