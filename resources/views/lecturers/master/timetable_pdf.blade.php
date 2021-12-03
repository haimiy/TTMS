<!doctype html>
<html class="fixed">
<head>
{{--    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}" />--}}


{{--    <!-- Theme CSS -->--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/stylesheets/theme.css') }}" />--}}

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-family:"Courier New", Courier, monospace;
            font-size:80%;
        }
        .table td, .table th {
            font-size: 12px;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
<div class="col-lg-12" style="padding-left: 50px;padding-right: 50px;">
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
                                <td style="vertical-align: middle; horiz-align: center;" class="center">---</td>
                        @endif

                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="page-break"></div>
    @endforeach
</div>
{{--@include('layouts.main_js')--}}
</body>
</html>
