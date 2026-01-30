@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        @if (session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                    stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <polyline points="9 11 12 14 22 4"></polyline>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
                <strong>{{ session('status') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i
                            class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
        @endif

        <div class="col-lg-12">
            <div class="card dz-card" id="accordion-four">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">View Receivables</h4>
                    </div>

                    <div>
                        <a href="{{ route('invoices.index') }}" class="btn btn-primary btn-sm ms-2">+ Add Payment</a>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent-3">
                    <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel" aria-labelledby="home-tab-3">
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table id="example4" class="display table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Client ID</th>
                                            <th>Client Name</th>
                                            <th>Client Phone</th>
                                            <th>Client Email</th>
                                            <th>Amount Owed</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($receivables as $index => $receivable)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $receivable->client_id ?? 'N/A' }}</td>
                                                <td>{{ $receivable->client_name ?? 'N/A' }}</td>
                                                <td>{{ $receivable->client_phone }}</td>
                                                <td>{{ $receivable->client_email }}</td>
                                                <td>{{ $receivable->amount_owed }}</td>
                                                <td>{{ $receivable->report_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4"></th>
                                            <th>Total:</th>
                                            <th>{{ $total['amount'] }}</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
@endsection
