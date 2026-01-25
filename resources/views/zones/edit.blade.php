@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-6 col-lg-12">
            <div class="card">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Edit Zones</h4>
                    </div>

                    <div>
                        <a href="{{ route('zones.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{ route('zones.update', $zone) }}">
                            @csrf

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Name"
                                        value="{{ $zone->name }}">

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
                                            <option value="{{ $zonalSalesOfficer->id }}"
                                                {{ $zone->zonal_sales_officer_id == $zonalSalesOfficer->id ? 'selected' : '' }}>
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

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status"
                                        class="default-select form-control @error('status') is-invalid @enderror">
                                        <option disabled selected>Select Status</option>
                                        <option value="Active"
                                            {{ old('status', $zone->status ?? '') == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="InActive"
                                            {{ old('status', $zone->status ?? '') == 'InActive' ? 'selected' : '' }}>In
                                            Active</option>
                                    </select>

                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
@endsection
