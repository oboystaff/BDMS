@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-6 col-lg-12">
            <div class="card">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">View School</h4>
                    </div>

                    <div>
                        <a href="{{ route('schools.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{ route('schools.update', $school) }}">
                            @csrf

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label class="form-label">School Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="School Name"
                                        value="{{ $school->name }}" readonly>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">School Type</label>
                                    <input type="text" name="type"
                                        class="form-control @error('type') is-invalid @enderror" placeholder="School Type"
                                        value="{{ $school->type }}" readonly>

                                    @error('type')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">School Category</label>
                                    <input type="text" name="category"
                                        class="form-control @error('category') is-invalid @enderror"
                                        placeholder="School Category" value="{{ $school->category }}" readonly>

                                    @error('category')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                        value="{{ $school->email }}" readonly>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror" placeholder="Phone"
                                        value="{{ $school->phone }}" readonly>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Contact Person Name</label>
                                    <input type="text" name="contact_person_name"
                                        class="form-control @error('contact_person_name') is-invalid @enderror"
                                        placeholder="Contact Person Name" value="{{ $school->contact_person_name }}"
                                        readonly>

                                    @error('contact_person_name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Contact Person Phone</label>
                                    <input type="text" name="contact_person_phone"
                                        class="form-control @error('contact_person_phone') is-invalid @enderror"
                                        placeholder="Contact Person Phone" value="{{ $school->contact_person_phone }}"
                                        readonly>

                                    @error('contact_person_phone')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Region</label>
                                    <input type="text" name="region_id"
                                        class="form-control @error('region_id') is-invalid @enderror"
                                        placeholder="Region ID" value="{{ $school->region->name ?? 'N/A' }}" readonly>

                                    @error('region_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Zone</label>
                                    <input type="text" name="zone_id"
                                        class="form-control @error('zone_id') is-invalid @enderror" placeholder="Zone ID"
                                        value="{{ $school->zone->name ?? 'N/A' }}" readonly>

                                    @error('zone_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Territory</label>
                                    <input type="text" name="territory_id"
                                        class="form-control @error('territory_id') is-invalid @enderror"
                                        placeholder="Territory ID" value="{{ $school->territory->name ?? 'N/A' }}"
                                        readonly>

                                    @error('territory_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Zonal Sales Officer</label>
                                    <input type="text" name="zso"
                                        class="form-control @error('zso') is-invalid @enderror"
                                        placeholder="Contact Person Phone" value="{{ $school->zso->name ?? 'N/A' }}"
                                        readonly>

                                    @error('zonal_sales_officer_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Latitude</label>
                                    <input type="number" step="any" name="latitude"
                                        class="form-control @error('latitude') is-invalid @enderror"
                                        placeholder="Latitude" value="{{ $school->latitude }}" readonly>

                                    @error('latitude')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Longitude</label>
                                    <input type="number" step="any" name="longitude"
                                        class="form-control @error('longitude') is-invalid @enderror"
                                        placeholder="Longitude" value="{{ $school->longitude }}" readonly>

                                    @error('longitude')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
@endsection
