@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card dz-card" id="accordion-four">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">View Receivable Report</h4>
                    </div>
                </div>

                <input type="hidden" name="receivable-report_url" url="{{ route('receivable-reports.index') }}">

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

                            <div class="col-md-6 mb-4" style="display:none">
                                <label class="form-label">Report Type</label>
                                <select class="form-select @error('report_type') is-invalid @enderror" id="report_type"
                                    name="report_type">
                                    <option value="1">Book Report</option>
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
                                                <th>Client Name</th>
                                                <th>Client Phone</th>
                                                <th>Client Email</th>
                                                <th>Amount Owed</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4"></th>
                                                <th id='title'></th>
                                                <th id='amount_total'></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
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
    <script src="{{ asset('assets/js/report/receivable-report.js?v1=' . time()) }}"></script>
@endsection
