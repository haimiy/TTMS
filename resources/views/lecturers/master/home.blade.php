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
                <a href="/master/home">
                    <i class="fa fa-dashboard"></i>
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
                <h3>{{ $count_subjects }}</h3>
                <p> Total subjects </p>
            </div>
            <div class="icon">
                <i class="fa fa-book" aria-hidden="true"></i>
            </div>
            <a href="course.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-green">
            <div class="inner">
                <h3>{{$count_classes}}</h3>
                <p> Total Classes </p>
            </div>
            <div class="icon">
                <i class="fa fa-group" aria-hidden="true"></i>
            </div>
            <a href="class_list.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-red">
            <div class="inner">
                <h3>{{$count_lecturers}}</h3>
                <p> Total lecturers </p>
            </div>
            <div class="icon">
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <a href="lecturers.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-orange">
            <div class="inner">
                <h3>{{$count_rooms}}</h3>
                <p> Total rooms </p>
            </div>
            <div class="icon">
                <i class="fa fa-home" aria-hidden="true"></i>
            </div>
            <a href="rooms.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
    <!-- end: page -->
@endsection
@section('script')
//TODO: page script 
@endsection