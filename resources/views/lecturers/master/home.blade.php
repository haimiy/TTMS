@extends('layouts.main')
@section('side_bar')
    @include('lecturers.master.layouts.side_bar')
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

<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-blue">
            <div class="inner">
                <h3>10</h3>
                <p> Total subjects </p>
            </div>
            <div class="icon">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
            </div>
            <a href="course.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-green">
            <div class="inner">
                <h3>20</h3>
                <p> Total Classes </p>
            </div>
            <div class="icon">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
            </div>
            <a href="class_list.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-red">
            <div class="inner">
                <h3>50</h3>
                <p> Total lecturers </p>
            </div>
            <div class="icon">
                <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            <a href="lecturers.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-orange">
            <div class="inner">
                <h3>30</h3>
                <p> Total rooms </p>
            </div>
            <div class="icon">
                <i class="fa fa-money" aria-hidden="true"></i>
            </div>
            <a href="rooms.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="col-12 text-center">
    <input type="submit" onclick="generateTimetable()" id="" value="Generate Timetable"
        class="mb-xs mt-xs mr-xs btn btn-primary">
    <br>
    <br>
</div>
<!-- TableDiv -->
<div id="generateTimetable" style="display:none;">

    <!-- start: page -->
    <section class="panel">

        <div class="panel-body">

            <table class="table table-bordered table-striped mb-none" id="datatable-default">

                <thead>
                    <tr style="background-color :#34495e; color:white;">
                        <th>TIMES</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursaday</th>
                        <th>Friday</th>
                    </tr>
                </thead>
                <tbody id="table-body">

                </tbody>
            </table>
        </div>
    </section>
</div>
    <!-- end: page -->
@endsection
@section('script')
<!-- Examples -->
<script src="{{ asset('assets/javascripts/dashboard/examples.dashboard.js') }}"></script>
<!-- Examples -->
<script src="{{ asset('assets/javascripts/tables/examples.datatables.default.js') }}"></script>
<script src="{{ asset('assets/javascripts/tables/examples.datatables.row.with.details.js') }}"></script>
<script src="{{ asset('assets/javascripts/tables/examples.datatables.tabletools.js') }}"></script>
<!-- Examples -->
<script src="{{ asset('assets/javascripts/ui-elements/examples.modals.js') }}"></script>
<!-- Examples -->
<script src="{{ asset('assets/javascripts/forms/examples.wizard.js') }}"></script>
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