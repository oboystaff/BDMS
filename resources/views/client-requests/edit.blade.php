@extends('layouts.base')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/autocomplete.css') }}">
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-6 col-lg-12">
            <div class="card">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Edit Book Request</h4>
                    </div>

                    <div>
                        <a href="{{ route('client-requests.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{ route('client-requests.update', $clientRequest) }}">
                            @csrf

                            <input type="hidden" name="book_id" value="{{ $clientRequest->book_id ?? '' }}" />
                            <input type="hidden" name="subject_id" value="{{ $clientRequest->subject_id ?? '' }}" />
                            <input type="hidden" name="level_id" value="{{ $clientRequest->level_id ?? '' }}" />
                            <input type="hidden" name="client_id" id="client_id" value="{{ $clientRequest->client_id }}" />

                            <div class="row">
                                <div class="alert alert-warning alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                    <strong>NOTE: AVAILABLE BOOK DETAILS HERE</strong>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Subject</label>
                                    <input type="text" name="subject"
                                        class="form-control @error('subject') is-invalid @enderror"
                                        placeholder="Subject Name"
                                        value="{{ $clientRequest->book->subject->name ?? 'N/A' }}" readonly>

                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Level</label>
                                    <input type="text" name="level"
                                        class="form-control @error('level') is-invalid @enderror" placeholder="Level Name"
                                        value="{{ $clientRequest->book->level->name ?? 'N/A' }}" readonly>

                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Unit Price</label>
                                    <input type="text" name="unit_price" id="unit_price"
                                        class="form-control @error('unit_price') is-invalid @enderror"
                                        placeholder="Unit Price" value="{{ $clientRequest->book->unit_price }}" readonly>

                                    @error('unit_price')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Available Stock</label>
                                    <input type="text" name="available_stock"
                                        class="form-control @error('available_stock') is-invalid @enderror"
                                        placeholder="Available Stock" value="{{ $clientRequest->book->quantity }}"
                                        readonly>

                                    @error('available_stock')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="alert alert-success alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                    <strong>NOTE: BOOK REQUEST DETAILS HERE</strong>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Client Name</label>
                                    <div class="autocomplete">
                                        <input type="text" name="client" id="client"
                                            class="form-control @error('client') is-invalid @enderror"
                                            placeholder="Client Name" value="{{ $clientRequest->client->name ?? 'N/A' }}"
                                            readonly>
                                    </div>

                                    @error('client')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Quantity</label>
                                    <input type="text" name="quantity" id="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        placeholder="Book Quantity" value="{{ $clientRequest->quantity }}">

                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">Amount</label>
                                    <input type="text" name="amount" id="amount"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        placeholder="Book Amount" value="{{ $clientRequest->amount }}" readonly>

                                    @error('amount')
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
    <script>
        function autocomplete(inp, arr) {
            var currentFocus;
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;

                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");

                this.parentNode.appendChild(a);

                for (i = 0; i < arr.length; i++) {

                    if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {

                        b = document.createElement("DIV");

                        b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) +
                            "</strong>";
                        b.innerHTML += arr[i].name.substr(val.length);

                        b.innerHTML += "<input type='hidden' value='" + arr[i].name + "'>";
                        b.innerHTML += "<input type='hidden' value='" + arr[i].id + "'>";

                        b.addEventListener("click", function(e) {

                            inp.value = this.getElementsByTagName("input")[0].value;
                            var customerId = this.getElementsByTagName("input")[1].value;
                            document.getElementById('client_id').value = customerId;

                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });


            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    currentFocus++;

                    addActive(x);
                } else if (e.keyCode == 38) {
                    currentFocus--;
                    addActive(x);
                } else if (e.keyCode == 13) {
                    e.preventDefault();
                    if (currentFocus > -1) {

                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                if (!x) return false;
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }

            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }

        var clients = @json($clients);

        autocomplete(document.getElementById("client"), clients);

        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById("quantity");
            const amountInput = document.getElementById("amount");
            const unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;

            quantityInput.addEventListener('input', function() {
                const quantity = parseFloat(this.value) || 0;
                amountInput.value = (quantity * unitPrice).toFixed(2);
            });
        });
    </script>
@endsection
