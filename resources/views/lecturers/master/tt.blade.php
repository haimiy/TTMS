@extends('layouts.main')
@section('side_bar')
    @include('lecturers.master.layouts.side_bar')
@endsection
@section('content')
    <header class="page-header">
        <h2>Timetable</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Timetable</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <!-- TableDiv -->
    <div id="generateTimetable">

        <section class="panel">

            <div class="panel-body">

                <table class="table table-bordered table-striped mb-none" id="datatable-default">

                    <thead>
                        <tr style="background-color :#34495e; color:white;">
                            <th class="text-center" colspan="5">
                                {{ $class_name }} 
                            </th>
                        </tr>
                        <tr style="background-color :#34495e; color:white;">   
                            <th>Day Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Subject Name</th>
                            <th>Semister Name</th>
                        </tr>
                    
                    </thead>
                    <tbody>
                        @foreach ($classTimetable as $timetable)
                        <tr>
                            <td>{{ $timetable->day_name }}</td>
                            <td>{{ $timetable->start_time }}</td>
                            <td>{{ $timetable->end_time }}</td>
                            <td>{{ $timetable->subject_name }}</td>
                            <td>{{ $timetable->semister_name }}</td>
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
    <!-- Examples -->
    <script src="{{ asset('assets/javascripts/tables/examples.datatables.default.js') }}"></script>
    <!-- Examples -->
    <script src="{{ asset('assets/javascripts/ui-elements/examples.modals.js') }}"></script>
    <!-- Examples -->
    <script>
        $(document).ready(function() {
            $('#datatable-default').dataTable();
        });

        var tableBody = $("#table-body");
        var tableDiv = $("#generateTimetable");

        function generateTimetable() {
            setTableLoading();
            tableDiv.show();
            tableBody.html();
        }

        function setTableLoading() {
            tableBody.html(
                '<tr><td class="mx-auto text-center" colspan="6"> <img src="{{ asset('assets/images/loading.svg') }}" style="width:30px; height:30px; "> </td></tr>'
            );
        }
    </script>
@endsection
