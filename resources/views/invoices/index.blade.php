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

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                    stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <polyline points="9 11 12 14 22 4"></polyline>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i
                            class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
        @endif

        <div class="col-lg-12">
            <div class="card dz-card" id="accordion-four">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">View Invoices</h4>
                    </div>

                    <div>
                        <a href="{{ route('sales.index') }}" class="btn btn-primary btn-sm ms-2">+ Add Invoice</a>
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
                                            <th>Invoice ID</th>
                                            <th>Client ID</th>
                                            <th>Client Name</th>
                                            <th>Book ID</th>
                                            <th>Subject</th>
                                            <th>Level</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th>ZSO</th>
                                            <th>Created By</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $index => $invoice)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $invoice->invoice_id }}</td>
                                                <td>{{ $invoice->client_id }}</td>
                                                <td>{{ $invoice->client->name ?? 'N/A' }}</td>
                                                <td>{{ $invoice->book_id }}</td>
                                                <td>{{ $invoice->sale->clientRequest->subject->name ?? 'N/A' }}</td>
                                                <td>{{ $invoice->sale->clientRequest->level->name ?? 'N/A' }}</td>
                                                <td>{{ $invoice->sale->clientRequest->unit_price ?? 0 }}</td>
                                                <td>{{ $invoice->sale->clientRequest->quantity ?? 0 }}</td>
                                                <td>{{ number_format($invoice->amount, 2) }}</td>
                                                <td>{{ $invoice->sale->zso->name ?? 'N/A' }}</td>
                                                <td>{{ $invoice->createdBy->name ?? 'N/A' }}</td>
                                                <td>{{ $invoice->created_at }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <div class="btn-link" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                    stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                </path>
                                                                <path
                                                                    d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                    stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                </path>
                                                                <path
                                                                    d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                    stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <div class="py-2">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('invoices.show', $invoice) }}">View
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('payments.create', $invoice) }}">Make
                                                                    Payment
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="8"></th>
                                            <th>Total:</th>
                                            <th>{{ $total['amount'] }}</th>
                                            <th colspan="4"></th>
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
