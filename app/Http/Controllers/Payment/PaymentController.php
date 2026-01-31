<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\ClientRequest;
use App\Models\Invoice;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('payments.view')) {
            abort(403, 'Unauthorized action.');
        }

        $payments = Payment::orderBy('created_at', 'DESC')
            ->when($request->display == "daily", function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->when($request->display == "weekly", function ($query) {
                $query->whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            })
            ->when($request->display == "monthly", function ($query) {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            })
            ->when($request->display == "yearly", function ($query) {
                $query->whereYear('created_at', Carbon::now()->year);
            })
            ->get();

        $amount = $payments->sum('amount');

        $total = [
            'amount' => isset($amount) ? number_format($amount, 2) : 0
        ];

        return view('payments.index', compact('payments', 'total'));
    }

    public function create(Invoice $invoice)
    {
        if (!auth()->user()->can('payments.create')) {
            abort(403, 'Unauthorized action.');
        }

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
