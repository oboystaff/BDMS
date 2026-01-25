@extends('layouts.base')

@section('page-styles')
    <style>
        .label {
            display: flex;
            justify-content: center;
        }

        .label label {
            font-weight: bold;
        }
    </style>
@endsection

@section('page-content')
    <div class="row">
        <div class="col-xl-12 ms-auto mt-xl-0 mt-4">
            <div class="row mt-4 ms-auto">
                <div class="row col-xl-9 ">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body ">
                                <div class="icon-box text-muted float-end">
                                    <i class="fs-18 fa fa-users"></i>
                                </div>
                                <a href="#">
                                    <span class="fw-normal text-orange  mt-n2"><span class="fs-46">0.0</span> <span
                                            class="fs-14 fw-lighter ms-1">Customers</span></span>
                                </a>
                                <a href="#">
                                    <p class="mb-0 fs-12 fw-light text-green text-end"><span
                                            class="fs-16 fw-lighter ms-n2">0.0</span> - active</p>
                                </a>
                                <a href="#">
                                    <p class="fs-12 fw-light text-muted text-end"><span
                                            class="fs-16 fw-lighter ms-n2">0.0</span> - inactive
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body ">
                                <div class="icon-box text-muted float-end">
                                    <i class="fs-18 fa fa-shopping-cart"></i>
                                </div>
                                <a href="#">
                                    <span class="fw-normal text-green  mt-n2"><span class="fs-46">0.0</span> <span
                                            class="fs-14 fw-lighter ms-1">This week Request</span>
                                    </span>
                                </a>
                                <a href="#">
                                    <p class="mb-0 fs-12 fw-light text-black text-end"><span
                                            class="fs-16 fw-semibold ms-n2">0.0</span> - month
                                        pickups</p>
                                </a>
                                <a href="#">
                                    <p class="fs-12 fw-light text-black text-end"><span class="fs-16 fw-semibold ms-n2">0.0
                                        </span> - year
                                        pickups</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body ">
                                <div class="icon-box text-muted float-end">
                                    <i class="fs-18 fa fa-clock"></i>
                                </div>
                                <a href="#">
                                    <span class="fw-normal text-red  mt-n2"><span class="fs-46">0.0</span> <span
                                            class="fs-14 fw-lighter ms-1">Pending this week</span>
                                    </span>
                                </a>
                                <a href="#">
                                    <p class="mb-0 fs-12 fw-light text-black text-end"><span
                                            class="fs-16 fw-semibold ms-n2">0.0</span> -
                                        month pending</p>
                                </a>
                                <a href="#">
                                    <p class="fs-12 fw-light text-black text-end"><span class="fs-16 fw-semibold ms-n2">0.0
                                        </span> -
                                        year pending</p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class=" ">
                        <div class="col-xl-12">
                            <div class="card dz-card" id="nav-pills-tabs">
                                <div class="card-header flex-wrap border-0">
                                    <h4 class="card-title">Pickup Trends</h4>

                                    <ul class="nav nav-pills justify-content-end mt-n3">
                                        <li class=" nav-item">
                                            <a href="#navpills2-1" class="nav-link active" data-bs-toggle="tab"
                                                aria-expanded="false">Daily</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#navpills2-2" class="nav-link" data-bs-toggle="tab"
                                                aria-expanded="false">Monthly</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent4">
                                    <div class="tab-pane fade show active" id="NavPillsTabs" role="tabpanel"
                                        aria-labelledby="home-tab4">
                                        <div class="card-body pt-0">
                                            <div class="tab-content">
                                                <div id="navpills2-1" class="tab-pane active">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div style="width: 100%; ">
                                                                <canvas id="dailyPickupChart" height="78"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="navpills2-2" class="tab-pane">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div style="width: 100%; ">
                                                                <canvas id="monthlyPickupChart" height="78"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="card col-xl-3 ms-2 bg-gradient-info">
                    <div class=" mt-md-0 mt-4 ">
                        <div class="card-body text-center ">
                            <h4 class="text-primary"><span>Schedule this Week</span> <i class="fs-18 fa fa-bell"></i></h4>
                        </div>
                        <div class="table-responsive " style="height: 480px; overflow-y: auto;">
                            <table class="table  ">
                                <thead class="bg-gradient-info sticky-top">
                                    <tr class="text-info ">
                                        <th class="">
                                            Customer
                                        </th>
                                        <th class="text-right">
                                            Date
                                        </th>
                                        <th class="text-right">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $schedule)
                                        <tr>
                                            <td>{{ $schedule->customer->name }}</td>
                                            <td>{{ $schedule->schedule_date }}</td>
                                            <td>{{ $schedule->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="col-xl-12">
                <div class="card dz-card" id="nav-pills-tabs">
                    <div class="card-header flex-wrap border-0">
                        <h4 class="text-Primary">Waste Composition</h4>

                        <ul class="nav nav-pills justify-content-end mb-4 float-end">
                            <li class=" nav-item">
                                <a href="#navpills22-1" class="nav-link active" data-bs-toggle="tab"
                                    aria-expanded="false">Daily</a>
                            </li>
                            <li class="nav-item">
                                <a href="#navpills22-2" class="nav-link" data-bs-toggle="tab"
                                    aria-expanded="false">Monthly</a>
                            </li>
                            <li class="nav-item">
                                <a href="#navpills22-3" class="nav-link" data-bs-toggle="tab"
                                    aria-expanded="false">Yearly</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent4">
                        <div class="tab-pane fade show active" id="NavPillsTabs" role="tabpanel"
                            aria-labelledby="home-tab4">
                            <div class="card-body pt-0 mt-n4">
                                <div class="tab-content">
                                    <div id="navpills22-1" class="tab-pane active">
                                        <div class="row">
                                            <div class="mb-4 col-md-6">
                                                <canvas id="dailyPieChartKg" width="300" height="300"></canvas>
                                            </div>

                                            <div class="mb-4 col-md-6">
                                                <canvas id="dailyPieChartM3" width="300" height="300"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="navpills22-2" class="tab-pane">
                                        <div class="row">
                                            <div class="mb-4 col-md-6">
                                                <canvas id="monthlyPieChartKg" width="300" height="300"></canvas>
                                            </div>

                                            <div class="mb-4 col-md-6">
                                                <canvas id="monthlyPieChartM3" width="300" height="300"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="navpills22-3" class="tab-pane">
                                        <div class="row">
                                            <div class="mb-4 col-md-6">
                                                <canvas id="yearlyPieChartKg" width="300" height="300"></canvas>
                                            </div>

                                            <div class="mb-4 col-md-6">
                                                <canvas id="yearlyPieChartM3" width="300" height="300"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('page-scripts')
        <script src="{{ asset('assets/js/dashboard/dashboard.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/crm.js') }}"></script>
    @endsection
