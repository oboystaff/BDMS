@extends('layouts.base')

@section('page-styles')
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('page-content')
    <div class="dashboard-container">
        <div class="row">
            <div class="col-xl-12">

                <!-- Schools Section -->
                <div class="section-divider">
                    <h2 class="section-title">
                        Schools Overview
                    </h2>
                    <p class="section-subtitle">Monitor and track school registrations and activity</p>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card stat-card orange">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('schools.index', ['display' => 'all']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-school"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['totalSchool'] }}</div>
                                    <div class="stat-label">Total Schools Registered</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card stat-card green">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('schools.index', ['display' => 'active']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['activeSchool'] }}</div>
                                    <div class="stat-label">Active Schools</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card stat-card red">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('schools.index', ['display' => 'inactive']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-pause-circle"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['inactiveSchool'] }}</div>
                                    <div class="stat-label">Inactive Schools</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bookshops Section -->
                <div class="section-divider">
                    <h2 class="section-title">
                        Bookshops Overview
                    </h2>
                    <p class="section-subtitle">Track bookshop partnerships and engagement</p>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card stat-card orange">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('bookshops.index', ['display' => 'all']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-store"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['totalBookshop'] }}</div>
                                    <div class="stat-label">Total Bookshops Registered</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card stat-card green">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('bookshops.index', ['display' => 'active']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['activeBookshop'] }}</div>
                                    <div class="stat-label">Active Bookshops</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card stat-card red">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('bookshops.index', ['display' => 'inactive']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-pause-circle"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['inactiveBookshop'] }}</div>
                                    <div class="stat-label">Inactive Bookshops</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Requests Section -->
                <div class="section-divider">
                    <h2 class="section-title">
                        Request Analytics
                    </h2>
                    <p class="section-subtitle">Monitor request volumes and pending actions</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card stat-card orange">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('client-requests.index', ['display' => 'pending']) }}"
                                    class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-hourglass-half"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['pendingRequest'] }}</div>
                                    <div class="stat-label">Pending Requests</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card blue">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('client-requests.index', ['display' => 'weekly']) }}"
                                    class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-calendar-week"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['weeklyRequest'] }}</div>
                                    <div class="stat-label">Total Requests This Week</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card blue">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('client-requests.index', ['display' => 'monthly']) }}"
                                    class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-calendar-alt"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['monthlyRequest'] }}</div>
                                    <div class="stat-label">Total Requests This Month</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card green">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('client-requests.index', ['display' => 'yearly']) }}"
                                    class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-chart-line"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['yearlyRequest'] }}</div>
                                    <div class="stat-label">Total Requests This Year</div>
                                </a>
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
