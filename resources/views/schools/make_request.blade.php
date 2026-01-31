@extends('layouts.base')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/autocomplete.css') }}">
@endsection

@section('page-content')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-lg-6 col-lg-12">
            <div class="card">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Book Request Form</h4>
                    </div>

                    <div>
                        <a href="{{ route('schools.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{ route('client-requests.preview') }}">
                            @csrf

                            <div class="row">
                                <div class="alert alert-warning alert-dismissible fade show">
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
                                    <input type="text" name="client_id" id="client_id"
                                        class="form-control @error('client_id') is-invalid @enderror"
                                        placeholder="Client Id" value="{{ $school->reg_id }}" readonly>

                                    @error('client_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Client Name</label>
                                    <input type="text" name="client_name" id="client_name"
                                        class="form-control @error('client_name') is-invalid @enderror"
                                        placeholder="Client Name" value="{{ $school->name }}" readonly>

                                    @error('client_name')
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
                                    <strong>NOTE: BOOK REQUEST DETAILS HERE</strong>
                                </div>

                                <div class="tab-content" id="myTabContent-3">
                                    <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel"
                                        aria-labelledby="home-tab-3">
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table id="example4" class="display table table-striped"
                                                    style="width: 100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Select</th>
                                                            <th>Subject</th>
                                                            <th>Level</th>
                                                            <th>Author</th>
                                                            <th>Price</th>
                                                            <th>Available</th>
                                                            <th>Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($books as $book)
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox"
                                                                        name="books[{{ $book->id }}][selected]"
                                                                        value="1">
                                                                </td>
                                                                <td>{{ $book->subject->name }}</td>
                                                                <td>{{ $book->level->name }}</td>
                                                                <td>{{ $book->author }}</td>
                                                                <td>{{ number_format($book->unit_price, 2) }}</td>
                                                                <td>{{ $book->quantity }}</td>
                                                                <td>
                                                                    <input type="number"
                                                                        name="books[{{ $book->id }}][quantity]"
                                                                        min="1" class="form-control">
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
@endsection
