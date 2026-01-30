@extends('layouts.base')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/autocomplete.css') }}">
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-6 col-lg-12">
            <div class="card">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Make Payment</h4>
                    </div>

                    <div>
                        <a href="{{ route('payments.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{ route('payments.store') }}">
                            @csrf

                            <input type="hidden" name="book_id" value="{{ $clientRequest->book_id ?? '' }}" />
                            <input type="hidden" name="subject_id" value="{{ $clientRequest->subject_id ?? '' }}" />
                            <input type="hidden" name="level_id" value="{{ $clientRequest->level_id ?? '' }}" />
                            <input type="hidden" name="client_id" id="client_id" value="{{ $clientRequest->client_id }}" />
                            <input type="hidden" name="invoice_id" value="{{ $invoice->invoice_id }}" />

                            <div class="row">
                                <div class="alert alert-warning alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                    <strong>NOTE: AVAILABLE BOOK DETAILS HERE</strong>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Subject</label>
                                    <input type="text" name="subject"
                                        class="form-control @error('subject') is-invalid @enderror"
                                        placeholder="Subject Name"
                                        value="{{ $clientRequest->book->subject->name ?? 'N/A' }}" readonly>

                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Level</label>
                                    <input type="text" name="level"
                                        class="form-control @error('level') is-invalid @enderror" placeholder="Level Name"
                                        value="{{ $clientRequest->book->level->name ?? 'N/A' }}" readonly>

                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Unit Price</label>
                                    <input type="text" name="unit_price" id="unit_price"
                                        class="form-control @error('unit_price') is-invalid @enderror"
                                        placeholder="Unit Price" value="{{ $clientRequest->book->unit_price }}" readonly>

                                    @error('unit_price')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Available Stock</label>
                                    <input type="text" name="available_stock"
                                        class="form-control @error('available_stock') is-invalid @enderror"
                                        placeholder="Available Stock" value="{{ $clientRequest->book->quantity }}"
                                        readonly>

                                    @error('available_stock')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="alert alert-success alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                    <strong>NOTE: CLIENT DETAILS HERE</strong>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Client ID</label>
                                    <div class="autocomplete">
                                        <input type="text" name="client_id" id="client_id"
                                            class="form-control @error('client_id') is-invalid @enderror"
                                            placeholder="Client ID" value="{{ $clientRequest->client->reg_id ?? 'N/A' }}"
                                            readonly>
                                    </div>

                                    @error('client_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Client Name</label>
                                    <div class="autocomplete">
                                        <input type="text" name="client" id="client"
                                            class="form-control @error('client') is-invalid @enderror"
                                            placeholder="Client Name" value="{{ $clientRequest->client->name ?? 'N/A' }}"
                                            readonly>
                                    </div>

                                    @error('client')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Client Email</label>
                                    <div class="autocomplete">
                                        <input type="text" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Client Email"
                                            value="{{ $clientRequest->client->email ?? 'N/A' }}" readonly>
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Client Phone</label>
                                    <div class="autocomplete">
                                        <input type="text" name="phone" id="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Client Phone"
                                            value="{{ $clientRequest->client->phone ?? 'N/A' }}" readonly>
                                    </div>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="alert alert-primary alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                    <strong>NOTE: CLIENT INVOICE & PAYMENT DETAILS HERE</strong>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Quantity</label>
                                    <input type="text" name="quantity" id="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        placeholder="Book Quantity" value="{{ $invoice->quantity }}" readonly>

                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Invoice Amount</label>
                                    <input type="text" name="invoice_amount" id="invoice_amount"
                                        class="form-control @error('invoice_amount') is-invalid @enderror"
                                        placeholder="Book Amount" value="{{ $invoice->amount }}" readonly>

                                    @error('invoice_amount')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Payment Mode</label>
                                    <select class="form-control @error('payment_mode') is-invalid @enderror"
                                        name="payment_mode">
                                        <option disabled selected>Select Payment Mode</option>
                                        <option value="cash">Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="bank transfer">Bank Transfer</option>
                                    </select>

                                    @error('payment_mode')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Amount Paid</label>
                                    <input type="text" name="amount"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        placeholder="Amount Paid" id="amount">

                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4" id="cheque_no">
                                    <label class="form-label">Cheque Number</label>
                                    <input type="text" name="cheque_no"
                                        class="form-control @error('cheque_no') is-invalid @enderror"
                                        placeholder="Cheque number">

                                    @error('cheque_no')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4" id="bank_name">
                                    <label class="form-label">Bank Name</label>
                                    <input type="text" name="bank_name"
                                        class="form-control @error('bank_name') is-invalid @enderror"
                                        placeholder="Bank Name">

                                    @error('bank_name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Make Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/book.js') }}"></script>
@endsection
