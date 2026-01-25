@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-6 col-lg-12">
            <div class="card">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Add Requisition</h4>
                    </div>

                    <div>
                        <a href="{{ route('requisitions.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{ route('requisitions.store') }}">
                            @csrf

                            <input type="hidden" name="book_id" value="{{ $book->book_id }}" />
                            <input type="hidden" name="subject_id" value="{{ $book->subject_id }}" />
                            <input type="hidden" name="level_id" value="{{ $book->level_id }}" />

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

                                <div class="alert alert-success alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                    <strong>NOTE: BOOK REQUISITION DETAILS HERE</strong>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Quantity</label>
                                    <input type="text" name="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        placeholder="Book Quantity">

                                    @error('quantity')
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
