@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card dz-card">
                <div class="card-header d-flex justify-content-between flex-wrap">
                    <h4 class="card-title">
                        View Client Statement For ({{ $bookshop->name }})
                    </h4>

                    <a href="{{ route('bookshops.index') }}" class="btn btn-primary btn-sm">
                        Back
                    </a>
                </div>

                @if (session()->has('status'))
                    <div class="alert alert-success alert-dismissible fade show m-3">
                        <strong>{{ session('status') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="tab-content" id="myTabContent-3">
                    <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel" aria-labelledby="home-tab-3">
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table id="example4" class="display table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Debit (GHS)</th>
                                            <th>Credit (GHS)</th>
                                            <th>Balance (GHS)</th>
                                            <th>Source</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $balance = 0;
                                            $totalDebit = 0;
                                            $totalCredit = 0;
                                        @endphp

                                        @foreach ($statement as $index => $entry)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($entry['date'])->format('Y-m-d') }}
                                                </td>

                                                <td>{{ $entry['description'] }}</td>

                                                @if ($entry['type'] === 'Invoice')
                                                    @php
                                                        $balance += $entry['amount'];
                                                        $totalDebit += $entry['amount'];
                                                    @endphp
                                                    <td>{{ number_format($entry['amount'], 2) }}</td>
                                                    <td>0.00</td>
                                                    <td>{{ number_format($balance, 2) }}</td>
                                                    <td>{{ $entry['source'] }}</td>
                                                @else
                                                    @php
                                                        $balance -= $entry['amount'];
                                                        $totalCredit += $entry['amount'];
                                                    @endphp
                                                    <td>0.00</td>
                                                    <td>{{ number_format($entry['amount'], 2) }}</td>
                                                    <td>{{ number_format($balance, 2) }}</td>
                                                    <td>{{ $entry['source'] }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="3"><strong>Totals (GHS)</strong></td>
                                            <td><strong>{{ number_format($totalDebit, 2) }}</strong></td>
                                            <td><strong>{{ number_format($totalCredit, 2) }}</strong></td>
                                            <td><strong>{{ number_format($balance, 2) }}</strong></td>
                                            <td>—</td>
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
@endsection

@section('page-scripts')
@endsection
