@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        @if (session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                    stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <polyline points="9 11 12 14 22 4"></polyline>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
                <strong>{{ session('status') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i
                            class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
        @endif

        <div class="col-lg-12">
            <div class="card dz-card" id="accordion-four">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">View Bookshops</h4>
                    </div>

                    <div>
                        <a href="{{ route('bookshops.create') }}" class="btn btn-primary btn-sm ms-2">+ Add Bookshop</a>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent-3">
                    <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel" aria-labelledby="home-tab-3">
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table id="example4" class="display table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookshops as $index => $bookshop)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $bookshop->name }}</td>
                                                <td>{{ $bookshop->email }}</td>
                                                <td>{{ $bookshop->phone }}</td>
                                                <td>{{ $bookshop->contact_person_name ?? 'N/A' }}</td>
                                                <td>{{ $bookshop->contact_person_phone ?? 'N/A' }}</td>
                                                <td>{{ $bookshop->latitude }}, {{ $bookshop->longitude }}</td>
                                                <td>{{ $bookshop->region->name ?? 'N/A' }}</td>
                                                <td>{{ $bookshop->zone->name ?? 'N/A' }}</td>
                                                <td>{{ $bookshop->territory->name ?? 'N/A' }}</td>
                                                <td>{{ $bookshop->zso->name ?? 'N/A' }}</td>
                                                @if ($bookshop->status == 'Active')
                                                    <td><span
                                                            class="badge light badge-success">{{ $bookshop->status }}</span>
                                                    </td>
                                                @else
                                                    <td><span
                                                            class="badge light badge-danger">{{ $bookshop->status }}</span>
                                                    </td>
                                                @endif
                                                <td>{{ $bookshop->createdBy->name ?? 'N/A' }}</td>
                                                <td>{{ $bookshop->created_at }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <div class="btn-link" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                    stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                </path>
                                                                <path
                                                                    d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                    stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                </path>
                                                                <path
                                                                    d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                    stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <div class="py-2">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('bookshops.show', $bookshop) }}">View
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('bookshops.edit', $bookshop) }}">Edit
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('bookshops.make_request', $bookshop) }}">Make
                                                                    Request
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('bookshops.statement', $bookshop) }}">View
                                                                    Statement
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
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
        </div>
    </div>
@endsection

@section('page-scripts')
@endsection
