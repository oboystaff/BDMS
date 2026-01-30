@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-6 col-lg-12">
            <div class="card">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Book Return Form</h4>
                    </div>

                    <div>
                        <a href="{{ route('requisitions.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{ route('book-returns.store') }}">
                            @csrf

                            <input type="hidden" name="req_id" value="{{ $requisition->id }}" />
                            <input type="hidden" name="book_id" value="{{ $book->book_id }}" />
                            <input type="hidden" name="subject_id" value="{{ $book->subject_id }}" />
                            <input type="hidden" name="level_id" value="{{ $book->level_id }}" />
                            <input type="hidden" name="zonal_sales_officer_id" value="{{ $zso->id ?? '' }}" />
                            <input type="hidden" name="created_by" value="{{ $requisition->created_by }}" />

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
                                        placeholder="Subject Name" value="{{ $book->subject->name ?? 'N/A' }}" readonly>

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
                                        value="{{ $book->level->name ?? 'N/A' }}" readonly>

                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Unit Price</label>
                                    <input type="text" name="unit_price"
                                        class="form-control @error('unit_price') is-invalid @enderror"
                                        placeholder="Unit Price" value="{{ $book->unit_price }}" readonly>

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
                                        placeholder="Available Stock" value="{{ $book->quantity }}" readonly>

                                    @error('available_stock')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Author</label>
                                    <input type="text" name="author"
                                        class="form-control @error('author') is-invalid @enderror" placeholder="Author"
                                        value="{{ $book->author }}" readonly>

                                    @error('author')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror" placeholder="Title"
                                        value="{{ $book->title }}" readonly>

                                    @error('title')
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
                                    <strong>NOTE: ZONAL SALES OFFICER DETAILS HERE</strong>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Officer Name</label>
                                    <input type="text" name="officer_name"
                                        class="form-control @error('officer_name') is-invalid @enderror"
                                        placeholder="Officer Name" value="{{ $zso->name }}" readonly>

                                    @error('officer_name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Officer Phone</label>
                                    <input type="text" name="officer_phone"
                                        class="form-control @error('officer_phone') is-invalid @enderror"
                                        placeholder="Officer Phone" value="{{ $zso->phone }}" readonly>

                                    @error('officer_phone')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Officer Email</label>
                                    <input type="text" name="officer_email"
                                        class="form-control @error('officer_email') is-invalid @enderror"
                                        placeholder="Officer Email" value="{{ $zso->email }}" readonly>

                                    @error('officer_email')
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
                                    <strong>NOTE: BOOK RETURN DETAILS HERE</strong>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Quantity Requested</label>
                                    <input type="text" name="quantity_requested"
                                        class="form-control @error('quantity_requested') is-invalid @enderror"
                                        placeholder="Book Quantity" value="{{ $requisition->quantity }}" readonly>

                                    @error('quantity_requested')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Quantity Returned</label>
                                    <input type="text" name="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        placeholder="Quantity Returned">

                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Reason</label>
                                    <input type="text" name="reason"
                                        class="form-control @error('reason') is-invalid @enderror" placeholder="Reason">

                                    @error('reason')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
@endsection
