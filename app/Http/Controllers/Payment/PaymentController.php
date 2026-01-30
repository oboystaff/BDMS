<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\ClientRequest;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'DESC')->get();

        return view('payments.index', compact('payments'));
    }

    public function create(Invoice $invoice)
    {
        $clientRequest = ClientRequest::where('request_id', $invoice->sale->request_id)->first();

        return view('payments.create', compact('invoice', 'clientRequest'));
    }

    public function store(CreatePaymentRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['status'] = 'Success';

        $payment = Payment::create($data);

        return redirect()->route('payments.index')->with('status', 'Payment created successfully.');
    }

    public function show() {}

    public function edit() {}

    public function update() {}
}
