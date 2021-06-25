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

                <table class="table table-bordered table-striped mb-none">

                    <thead>
                        <tr>
                            <th class="text-center" colspan="6">
                                {{ $class_name }} Class Timetable
                            </th>
                        </tr>
                        <tr>
                            <th width="150">Time</th>
                            @foreach ($weekDays as $day)
                                <th>{{ $day->day_name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($timeslots as $time)
                            <tr>
                                <td>
                                    {{ Carbon\Carbon::parse($time->start_time)->format('H:i') . ' - ' . Carbon\Carbon::parse($time->end_time)->format('H:i') }}
                                </td>
                                <td>
                                    <?php var_dump($classTimetable)?>
                                </td>
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
