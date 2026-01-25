@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-6 col-lg-12">
            <div class="card">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Add Zones</h4>
                    </div>

                    <div>
                        <a href="{{ route('zones.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{ route('zones.store') }}">
                            @csrf

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Zonal Sales Officer</label>
                                    <select
                                        class="form-control default-select @error('zonal_sales_officer_id') is-invalid @enderror"
                                        name="zonal_sales_officer_id">
                                        <option disabled selected>Select Zonal Sales Officer</option>
                                        @foreach ($zonalSalesOfficers as $zonalSalesOfficer)
                                            <option value="{{ $zonalSalesOfficer->id }}">
                                                {{ $zonalSalesOfficer->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('zonal_sales_officer_id')
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
