@extends('layouts.main')
@section('side_bar')
    @include('students.layouts.side_bar')
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
        <table class="table table-bordered table-striped mb-none" >

<thead>
    <tr style="background-color :#34495e; color:white;">
        <th rowspan="2" style="width: 150px;">

        </th>
        <th class="text-center" colspan="6">
            {{ $semister_name }}
        </th>
    </tr>
    <tr style="background-color :#34495e; color:white;">
        @foreach($weekDays as $weekDay)
            <th>{{ $weekDay->day_name }}</th>
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

                @foreach ($classTimetable as $timetable)
                    @if($timetable->day_id==$weekDay->id && $timetable->slot_id == $timeslot->id)
                        @if($timetable->subject_start)

                        <td style="vertical-align: middle;" class="center" rowspan="{{ $timetable->subject_total }}">
                            {{ $timetable->class_name }}<br>{{ $timetable->subject_name }} <br> {{ $timetable->lecturer_name }} <br> {{ $timetable->room_name }}

                        </td>
                        @endif
        <?php $isNotEmpty = 1?>
                    @endif
                @endforeach
            @if($isNotEmpty == 0)
            <td style="vertical-align: middle;" class="center">---</td>
            @endif

        @endforeach
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