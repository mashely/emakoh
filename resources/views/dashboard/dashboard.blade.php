@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">{{ greeting() }}, {{ Auth::user()->name}}!</h4>
                                    <p class="text-muted mb-0">Here's are systems Overall Summary</p>
                                </div>
                                <div class="mt-3 mt-lg-0">
                                    <form action="javascript:void(0);">
                                        <div class="row g-3 mb-0 align-items-center">
                                            
                                            <!--end col-->
                                            @if ((Auth::user()->hasRole(2) || Auth::user()->hasRole(3)))
                                            <div class="col-auto">
                                                <a href="{{ route('client.form')}}">
                                                    <button type="button" class="btn btn-success"><i
                                                        class="ri-add-circle-line align-middle me-1"></i>
                                                    Add Client</button>
                                                </a>
                                               
                                            </div>
                                            @endif
                                           
                                            <!--end col-->
                                            {{-- <div class="col-auto">
                                                <button type="button"
                                                    class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i
                                                        class="ri-pulse-line"></i></button>
                                            </div> --}}
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                            </div><!-- end card header -->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p
                                                class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                Total Clients</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            {{-- <h5 class="text-success fs-14 mb-0">
                                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                +16.24 %
                                            </h5> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                    class="counter-value" data-target="{{ $data['total_client']}}">0</span>
                                            </h4>
                                            <a href="{{ route('clients.list')}}" class="text-decoration-underline">View All
                                                Clients</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-success rounded fs-3">
                                                <i class="bx bx-user text-success"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p
                                                class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                Total Reminders</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            {{-- <h5 class="text-danger fs-14 mb-0">
                                                <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                                -3.57 %
                                            </h5> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                    class="counter-value" data-target="{{ $data['total_reminder']}}">0</span></h4>
                                            <a href="{{ route('appointments.list')}}" class="text-decoration-underline">View all Reminders</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-info rounded fs-3">
                                                <i class="bx bx-list-ul text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p
                                                class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                Total Open Reminders</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            {{-- <h5 class="text-success fs-14 mb-0">
                                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                +29.08 %
                                            </h5> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                    class="counter-value" data-target="{{ $data['open_reminder']}}"></span>
                                            </h4>
                                            <a href="#" class="text-decoration-underline">View All Open Reminders</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-warning rounded fs-3">
                                                <i class="bx bx-list-ul text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p
                                                class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                               Total Closed Reminders</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            {{-- <h5 class="text-muted fs-14 mb-0">
                                                +0.00 %
                                            </h5> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                    class="counter-value" data-target="{{ $data['closed_reminder']}}"></span>
                                            </h4>
                                            <a href="#" class="text-decoration-underline">View All Closed Reminders</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary rounded fs-3">
                                                <i class="bx bx-list-ul text-primary"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div> <!-- end row-->

                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Clients vs Reminders (Visits) Chart</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div id="grouped_bar" data-colors='["--vz-primary", "--vz-success"]' class="apex-charts" dir="ltr"></div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>

                        <div class="col-xl-4">
                            <div class="card ">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Gender Segmentation</h4>
                                </div>
                                <div class="card-body">
                                    <div id="chart-pie" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="e-charts"></div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                       

                    </div>

                </div> <!-- end .h-100-->

            </div> <!-- end col -->
        </div>

    </div>
    <!-- container-fluid -->
</div>
    
@endsection

@push('scripts')


<script>

var chartPieColors = getChartColorsArray("chart-pie"),
    chartDom = document.getElementById("chart-pie"),
    myChart = echarts.init(chartDom);
(option = {
    tooltip: { trigger: "item" },
    legend: { orient: "vertical", left: "left", textStyle: { color: "#858d98" } },
    color: chartPieColors,
    series: [
        {
            name: "Access From",
            type: "pie",
            radius: "50%",
            data: [
                { value: "{{ $data['gender']['male']}}", name: "Male" },
                { value: "{{ $data['gender']['female']}}", name: "Female" },
                { value: "{{ $data['gender']['not_specified']}}", name: "N/A" },
                // { value: 484, name: "Union Ads" },
                // { value: 300, name: "Video Ads" },
            ],
            emphasis: { itemStyle: { shadowBlur: 10, shadowOffsetX: 0, shadowColor: "rgba(0, 0, 0, 0.5)" } },
        },
    ],
    textStyle: { fontFamily: "Poppins, sans-serif" },
}) && myChart.setOption(option);
</script>
<script>
    var chartGroupbarColors = getChartColorsArray("grouped_bar"),
    options = {
        series: [{ name: "Clients",data: [<?php echo ($data['clients']);?>] }, { name: "Visits", data: [<?php echo ($data['visits']);?>] }],
        chart: { type: "bar", height: 410, toolbar: { show: !1 } },
        plotOptions: { bar: { vertical: !0, dataLabels: { position: "top" } } },
        dataLabels: { enabled: !0, offsetX: -6, style: { fontSize: "12px", colors: ["#fff"] } },
        stroke: { show: !0, width: 1, colors: ["#fff"] },
        tooltip: { shared: !0, intersect: !1 },
        xaxis: { categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"] },
        colors: chartGroupbarColors,
    };
(chart = new ApexCharts(document.querySelector("#grouped_bar"), options)).render();
    </script>



    
@endpush