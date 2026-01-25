@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-6 col-lg-12">
            <div class="card">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Add New Stock</h4>
                    </div>

                    <div>
                        <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{ route('books.save_new_stock', $book) }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Subject</label>
                                    <input type="text" name="subject_id"
                                        class="form-control @error('subject_id') is-invalid @enderror" placeholder="Subject"
                                        value="{{ $book->subject->name ?? 'N/A' }}" readonly>

                                    @error('subject_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Level</label>
                                    <input type="text" name="level_id"
                                        class="form-control @error('level_id') is-invalid @enderror" placeholder="Level"
                                        value="{{ $book->level->name ?? 'N/A' }}" readonly>

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
                                        placeholder="Unit Price" value="{{ $book->unit_price }}" readonly>

                                    @error('unit_price')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Old Quantity </label>
                                    <input type="text" name="old_quantity" id="old_quantity"
                                        class="form-control @error('old_quantity') is-invalid @enderror"
                                        placeholder="Old Quantity" value="{{ $book->quantity }}" readonly>

                                    @error('old_quantity')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Minimum Stock Level</label>
                                    <input type="text" name="minimum_stock_level"
                                        class="form-control @error('minimum_stock_level') is-invalid @enderror"
                                        placeholder="Minimum Stock Level" value="{{ $book->minimum_stock_level }}"
                                        readonly>

                                    @error('minimum_stock_level')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label"><span style="color:green">New Quantity</span></label>
                                    <input type="text" name="new_quantity" id="new_quantity"
                                        class="form-control @error('new_quantity') is-invalid @enderror"
                                        placeholder="New Quantity">

                                    @error('new_quantity')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label"><span style="color:red">Current Quantity</span></label>
                                    <input type="text" name="quantity" id="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        placeholder="Current Quantity" value="{{ $book->quantity }}" readonly>

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
    <script>
        let oldQty = document.getElementById('old_quantity');
        let newQty = document.getElementById('new_quantity');
        let totalQty = document.getElementById('quantity');

        totalQty.value = oldQty.value || 0;

        newQty.addEventListener('input', function() {
            let oldValue = parseInt(oldQty.value) || 0;
            let newValue = parseInt(this.value) || 0;

            if (this.value === '') {
                totalQty.value = oldValue;
            } else {
                totalQty.value = oldValue + newValue;
            }
        });
    </script>
@endsection
