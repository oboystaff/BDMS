@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-6 col-lg-12">
            <div class="card">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Add Book</h4>
                    </div>

                    <div>
                        <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{ route('books.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Subject</label>
                                    <select class="form-control default-select @error('subject_id') is-invalid @enderror"
                                        name="subject_id">
                                        <option disabled selected>Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('subject_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Level</label>
                                    <select class="form-control default-select @error('level_id') is-invalid @enderror"
                                        name="level_id">
                                        <option disabled selected>Select Level</option>
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->id }}">
                                                {{ $level->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('level_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Unit Price</label>
                                    <input type="text" name="unit_price"
                                        class="form-control @error('unit_price') is-invalid @enderror"
                                        placeholder="Unit Price">

                                    @error('unit_price')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Quantity</label>
                                    <input type="text" name="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror" placeholder="Quantity">

                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Minimum Stock Level</label>
                                    <input type="text" name="minimum_stock_level"
                                        class="form-control @error('minimum_stock_level') is-invalid @enderror"
                                        placeholder="Minimum Stock Level">

                                    @error('minimum_stock_level')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Author</label>
                                    <input type="text" name="author"
                                        class="form-control @error('author') is-invalid @enderror" placeholder="Author">

                                    @error('author')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror" placeholder="Title">

                                    @error('title')
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
