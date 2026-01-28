@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-6 col-lg-12">
            <div class="card">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Edit School</h4>
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
                                        value="{{ $school->name }}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">School Type</label>
                                    <select name="type"
                                        class="default-select form-control @error('type') is-invalid @enderror">
                                        <option disabled selected>Select School Type</option>
                                        <option value="Private" {{ $school->type == 'Private' ? 'selected' : '' }}>Private
                                        </option>
                                        <option value="Public" {{ $school->type == 'Public' ? 'selected' : '' }}>Public
                                        </option>
                                    </select>

                                    @error('type')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">School Category</label>
                                    <select name="category"
                                        class="default-select form-control @error('category') is-invalid @enderror">
                                        <option disabled selected>Select School Category</option>
                                        <option value="Pre-School"
                                            {{ $school->category == 'Pre-School' ? 'selected' : '' }}>
                                            Pre-School
                                        </option>
                                        <option value="Basic" {{ $school == 'Basic' ? 'selected' : '' }}>Basic</option>
                                        <option value="Secondary" {{ $school->category == 'Secondary' ? 'selected' : '' }}>
                                            Secondary
                                        </option>
                                        <option value="Tertiary" {{ $school->category == 'Tertiary' ? 'selected' : '' }}>
                                            Tertiary
                                        </option>
                                        <option value="College" {{ $school->category == 'College' ? 'selected' : '' }}>
                                            College
                                        </option>
                                    </select>

                                    @error('category')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                        value="{{ $school->email }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror" placeholder="Phone"
                                        value="{{ $school->phone }}">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Contact Person Name</label>
                                    <input type="text" name="contact_person_name"
                                        class="form-control @error('contact_person_name') is-invalid @enderror"
                                        placeholder="Contact Person Name" value="{{ $school->contact_person_name }}">

                                    @error('contact_person_name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Contact Person Phone</label>
                                    <input type="text" name="contact_person_phone"
                                        class="form-control @error('contact_person_phone') is-invalid @enderror"
                                        placeholder="Contact Person Phone" value="{{ $school->contact_person_phone }}">

                                    @error('contact_person_phone')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Region</label>
                                    <select name="region_id"
                                        class="default-select form-control @error('region_id') is-invalid @enderror">
                                        <option disabled selected>Select Region</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}"
                                                {{ $school->region_id == $region->id ? 'selected' : '' }}>
                                                {{ $region->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('region_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Zone</label>
                                    <select name="zone_id"
                                        class="default-select form-control @error('zone_id') is-invalid @enderror">
                                        <option disabled selected>Select Zone</option>
                                        @foreach ($zones as $zone)
                                            <option value="{{ $zone->id }}"
                                                {{ $school->zone_id == $zone->id ? 'selected' : '' }}>
                                                {{ $zone->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('zone_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Territory</label>
                                    <select name="territory_id"
                                        class="default-select form-control @error('territory_id') is-invalid @enderror">
                                        <option disabled selected>Select Territory</option>
                                        @foreach ($territories as $territory)
                                            <option value="{{ $territory->id }}"
                                                {{ $school->territory_id == $territory->id ? 'selected' : '' }}>
                                                {{ $territory->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('territory_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Zonal Sales Officer</label>
                                    <select name="zonal_sales_officer_id"
                                        class="default-select form-control @error('zonal_sales_officer_id') is-invalid @enderror">
                                        <option disabled selected>Select Zonal Sales Officer</option>
                                        @foreach ($zonalSalesOfficers as $officer)
                                            <option value="{{ $officer->id }}"
                                                {{ $school->zonal_sales_officer_id == $officer->id ? 'selected' : '' }}>
                                                {{ $officer->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('zonal_sales_officer_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Latitude</label>
                                    <input type="number" step="any" name="latitude"
                                        class="form-control @error('latitude') is-invalid @enderror"
                                        placeholder="Latitude" value="{{ $school->latitude }}">

                                    @error('latitude')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Longitude</label>
                                    <input type="number" step="any" name="longitude"
                                        class="form-control @error('longitude') is-invalid @enderror"
                                        placeholder="Longitude" value="{{ $school->longitude }}">

                                    @error('longitude')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
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
