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
        <div class="col text-center">
            <a class="btn btn-primary" href="/timetable" style=" background-color: #34495e !important;" onclick="setTableLoading()"> <i class="fa fa-table"></i> Generate Timetable</a>

            @if(count($classes)>0)
                <a class="btn btn-primary" href="/timetable/download" style=" background-color: #34495e !important; margin-left: 30px;" onclick="setTableLoading()"><i class="fa fa-download"></i> Download Timetable</a>
            @endif
            <div id="setTableLoading" style="display: none;"></div>

            @foreach($classes as $class)
                <table class="table table-bordered mb-none" >
                    <thead>
                    <tr style="background-color :#34495e; color:white;">
                        <th rowspan="2" style="width: 150px;">

                        </th>
                        <th class="text-center" colspan="5">
                            <center>{{ $class["class_name"] }}</center>
                        </th>
                    </tr>
                    <tr style="background-color :#34495e; color:white;">
                        @foreach($weekDays as $weekDay)
                            <th><center>{{ $weekDay["day_name"] }}</center></th>
                        @endforeach
                    </tr>

                    </thead>
                    <tbody>
                    @foreach($timeslots as $timeslot)
                        <tr>
                            <td>
                                {{ $timeslot->start_time." - ".$timeslot->end_time }}
                            </td>
                            @foreach($weekDays as $weekDay)
                                <?php $isNotEmpty = 0?>

                                @foreach ($class["classTimetable"] as $timetable)
                                    @if($timetable->day_id==$weekDay->id && $timetable->slot_id == $timeslot->id)
                                        @if($timetable->subject_start)

                                            <td style="vertical-align: middle;" class="center" rowspan="{{ $timetable->subject_total }}">
                                                <center>
                                                    {{ $timetable->class_name }}<br>{{ $timetable->subject_name }} <br> {{ $timetable->lecturer_name }} <br> {{ $timetable->room_name }}
                                                </center>
                                            </td>
                                        @endif
                                        <?php $isNotEmpty = 1?>
                                    @endif
                                @endforeach
                                @if($isNotEmpty == 0)
                                    <center><td style="vertical-align: middle;" class="center">---</td></center>
                                @endif

                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="page-break"></div>
            @endforeach
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
