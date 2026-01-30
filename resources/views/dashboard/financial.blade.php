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
                        Receipts Overview
                    </h2>
                    <p class="section-subtitle">Monitor and track receipts and activity</p>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card stat-card orange">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('payments.index', ['display' => 'daily']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-school"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['dailyPayments'] }}</div>
                                    <div class="stat-label">Receipts Today</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card green">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('payments.index', ['display' => 'weekly']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['weeklyPayments'] }}</div>
                                    <div class="stat-label">Receipts This Week</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card green">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('payments.index', ['display' => 'monthly']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['monthlyPayments'] }}</div>
                                    <div class="stat-label">Receipts This Month</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card red">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('payments.index', ['display' => 'yearly']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-pause-circle"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['yearlyPayments'] }}</div>
                                    <div class="stat-label">Receipts This Year</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bookshops Section -->
                <div class="section-divider">
                    <h2 class="section-title">
                        Invoices Overview
                    </h2>
                    <p class="section-subtitle">Monitor and track invoices and activity</p>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card stat-card orange">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('invoices.index', ['display' => 'daily']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-store"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['dailyInvoices'] }}</div>
                                    <div class="stat-label">Invoices Today</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card green">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('invoices.index', ['display' => 'weekly']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['weeklyInvoices'] }}</div>
                                    <div class="stat-label">Invoices This Week</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card red">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('invoices.index', ['display' => 'monthly']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-pause-circle"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['monthlyInvoices'] }}</div>
                                    <div class="stat-label">Invoices This Month</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card red">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('invoices.index', ['display' => 'yearly']) }}" class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-pause-circle"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['yearlyInvoices'] }}</div>
                                    <div class="stat-label">Invoices This Year</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Requests Section -->
                <div class="section-divider">
                    <h2 class="section-title">
                        Receivables Overview
                    </h2>
                    <p class="section-subtitle">Monitor and track receivables and activity</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card stat-card orange">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('dashboard.receivable', ['display' => 'daily']) }}"
                                    class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-hourglass-half"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['dailyReceivables'] }}</div>
                                    <div class="stat-label">Receivables Today</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card blue">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('dashboard.receivable', ['display' => 'weekly']) }}"
                                    class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-calendar-week"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['weeklyReceivables'] }}</div>
                                    <div class="stat-label">Receivables This Week</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card blue">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('dashboard.receivable', ['display' => 'monthly']) }}"
                                    class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-calendar-alt"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['monthlyReceivables'] }}</div>
                                    <div class="stat-label">Receivables This Month</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card green">
                            <div class="card-body stat-card-body">
                                <a href="{{ route('dashboard.receivable', ['display' => 'yearly']) }}"
                                    class="stat-card-link">
                                    <div class="stat-icon">
                                        <i class="fa fa-chart-line"></i>
                                    </div>
                                    <div class="stat-number">{{ $total['yearlyReceivables'] }}</div>
                                    <div class="stat-label">Receivables This Year</div>
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
