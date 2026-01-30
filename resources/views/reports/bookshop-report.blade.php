@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card dz-card" id="accordion-four">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">View Bookshop Report</h4>
                    </div>
                </div>

                <input type="hidden" name="bookshop-report_url" url="{{ route('bookshop-reports.index') }}">

                <div class="card-body">
                    <div class="basic-form">
                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label class="form-label">From Date</label>
                                <input type="date" name="from_date" class="form-control">
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label">To Date</label>
                                <input type="date" name="to_date" class="form-control">
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Region</label>
                                <select name="region_id"
                                    class="default-select form-control @error('region_id') is-invalid @enderror">
                                    <option disabled selected>Select Region</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">
                                            {{ $region->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Zone</label>
                                <select name="zone_id"
                                    class="default-select form-control @error('zone_id') is-invalid @enderror">
                                    <option disabled selected>Select Zone</option>
                                    @foreach ($zones as $zone)
                                        <option value="{{ $zone->id }}">
                                            {{ $zone->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Territory</label>
                                <select name="territory_id"
                                    class="default-select form-control @error('territory_id') is-invalid @enderror">
                                    <option disabled selected>Select Territory</option>
                                    @foreach ($territories as $territory)
                                        <option value="{{ $territory->id }}">
                                            {{ $territory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status">
                                    <option disabled selected>Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="InActive">In Active</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-4" style="display:none">
                                <label class="form-label">Report Type</label>
                                <select class="form-select @error('report_type') is-invalid @enderror" id="report_type"
                                    name="report_type">
                                    <option value="1">Bookshop Report</option>
                                    <option value="2">Summary Report</option>
                                </select>
                            </div>

                            <center>
                                <div class="mb-4 col-md-12">
                                    <button type="submit" class="btn btn-primary generate_report"
                                        style="width:200px">Generate Report</button>
                                </div>
                            </center>
                            <hr />
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent-3">
                    <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel" aria-labelledby="home-tab-3">
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <div id="details">
                                    <table id="example4" class="display table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Client ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Contact Person</th>
                                                <th>Contact Person Phone</th>
                                                <th>GPS Location</th>
                                                <th>Region</th>
                                                <th>Zone</th>
                                                <th>Territory</th>
                                                <th>Zonal Officer</th>
                                                <th>Status</th>
                                                <th>Created By</th>
                                                <th>Created Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <div style="display:none" id="summary">
                                    <table id="example5" class="display table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th id="header">Name</th>
                                                <th>Total Customer</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th id="title"></th>
                                                <th id="customer_total"></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/report/bookshop-report.js?v1=' . time()) }}"></script>
@endsection
