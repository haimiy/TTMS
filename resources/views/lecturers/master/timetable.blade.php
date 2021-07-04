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
        <div class="row">
            <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h3 class="panel-title">Timetable parameters </h3>
                        </header>
                        <form action="/master/timetable/class">
                            @csrf
                        <div class="panel-body">
                            <div class="row">  
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label"><strong>Choose Semister</strong></label>
                                        <select name="semister_id" class="form-control">
                                            <option value="">--Select---</option>
                                            @foreach ( $semisters as $semister )
                                            <option  value="{{ $semister->id }}">{{ $semister->semister_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label"><strong>Choose Classes</strong></label>
                                        <select name="class_id" class="form-control">
                                            <option value="">--Select---</option>
                                            @foreach ( $classes as $classes )
                                            <option  value="{{ $classes->id }}">{{ $classes->class_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <footer class="panel-footer text-right">
                            <button class="btn btn-primary" style=" background-color: #34495e !important;">View Class Timetable</button>
                        </footer>
                    </form>
                    </section>
            </div>
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