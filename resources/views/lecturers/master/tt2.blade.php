@extends('layouts.main')
@section('side_bar')
    @include('lecturers.master.layouts.side_bar')
@endsection
@section('content')
    <style>
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {

            vertical-align: middle !important;
        }

    </style>
    <header class="page-header">
        <h2>Timetable</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="">
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

                <table class="table table-bordered table-striped mb-none" >

                    <thead>
                        <tr style="background-color :#34495e; color:white;">
                            <th class="text-center" colspan="6">
                                {{ $class_name }}
                            </th>
                        </tr>
                        <tr style="background-color :#34495e; color:white;">
                            <th>#</th>
                            <th>Time</th>
                            <th>Day Name</th>
                            <th>Period Info</th>
                        </tr>

                    </thead>
                    <tbody>
                    <?php
                    $prevDay="";
                    $day="";

                    $prevSub='';
                    $sub='';
                    ?>
                        @foreach ($classTimetable as $timetable)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $timetable->start_time." - ".$timetable->end_time }}</td>
                            @if($timetable->day_name != $prevDay)
                                <td rowspan="{{ $timetable->day_total }}" class="center" style="vertical-align: center!important; margin: 80px;">{{ $timetable->day_name }}  </td>
                                @php
                                    $prevDay= $timetable->day_name;
                                @endphp
                            @endif
                            @if($timetable->subject_name != $prevSub)
                                <td rowspan="{{ $timetable->subject_total }}" style="vertical-align: center!important; margin: 80px;">Subject: <b>{{ $timetable->subject_name }}</b> <br> Lecture: <b>{{ $timetable->lecturer_name }}</b> <br> Room: <b>{{ $timetable->room_name }}</b></td>
                                @php
                                    $prevSub= $timetable->subject_name;
                                @endphp
                            @endif
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
