@extends('admin.layout.layout')

@section('page_header')
    <link href="/resources/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="/resources/admin/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="/resources/admin/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="/resources/admin/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Admin Dashboard 2
                <small>statistics, charts, recent events and reports</small>
            </h1>
        </div>
        <!-- END PAGE TITLE -->
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/"></a>
            <i class="fa fa-circle">Dashboard</i>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 bordered">
                <div class="display">
                    <div class="number">
                        <h3 class="font-green-sharp">
                            <span data-counter="counterup" data-value="7800">0</span>
                            <small class="font-green-sharp">$</small>
                        </h3>
                        <small>TOTAL PROFIT</small>
                    </div>
                    <div class="icon">
                        <i class="icon-pie-chart"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                    </div>
                    <div class="status">
                        <div class="status-title"> progress</div>
                        <div class="status-number"> 76%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 bordered">
                <div class="display">
                    <div class="number">
                        <h3 class="font-red-haze">
                            <span data-counter="counterup" data-value="1349">0</span>
                        </h3>
                        <small>NEW FEEDBACKS</small>
                    </div>
                    <div class="icon">
                        <i class="icon-like"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                                        <span style="width: 85%;" class="progress-bar progress-bar-success red-haze">
                                            <span class="sr-only">85% change</span>
                                        </span>
                    </div>
                    <div class="status">
                        <div class="status-title"> change</div>
                        <div class="status-number"> 85%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 bordered">
                <div class="display">
                    <div class="number">
                        <h3 class="font-blue-sharp">
                            <span data-counter="counterup" data-value="567"></span>
                        </h3>
                        <small>NEW ORDERS</small>
                    </div>
                    <div class="icon">
                        <i class="icon-basket"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                                        <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
                                            <span class="sr-only">45% grow</span>
                                        </span>
                    </div>
                    <div class="status">
                        <div class="status-title"> grow</div>
                        <div class="status-number"> 45%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 bordered">
                <div class="display">
                    <div class="number">
                        <h3 class="font-purple-soft">
                            <span data-counter="counterup" data-value="276"></span>
                        </h3>
                        <small>NEW USERS</small>
                    </div>
                    <div class="icon">
                        <i class="icon-user"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                                        <span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
                                            <span class="sr-only">56% change</span>
                                        </span>
                    </div>
                    <div class="status">
                        <div class="status-title"> change</div>
                        <div class="status-number"> 57%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Revenue</span>
                        <span class="caption-helper">distance stats...</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="#">
                            <i class="icon-cloud-upload"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="#">
                            <i class="icon-wrench"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="#">
                            <i class="icon-trash"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="dashboard_amchart_1" class="CSSAnimationChart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase">Finance</span>
                        <span class="caption-helper">distance stats...</span>
                    </div>
                    <div class="actions">
                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                            <i class="fa fa-pencil"></i> Export </a>
                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                            <i class="fa fa-print"></i> Print </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="dashboard_amchart_3" class="CSSAnimationChart"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
@endsection

@section('page_footer')
    <script src="/resources/admin/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
            type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/amcharts/amcharts/themes/patterns.js"
            type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/horizontal-timeline/horizontal-timeline.js"
            type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js"
            type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js"
            type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js"
            type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js"
            type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js"
            type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js"
            type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js"
            type="text/javascript"></script>

    <script src="/resources/admin/assets/pages/js/dashboard.js" type="text/javascript"></script>
@endsection