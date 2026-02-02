<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;


class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('invoices.view')) {
            abort(403, 'Unauthorized action.');
        }

        $invoices = Invoice::orderBy('created_at', 'DESC')
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

        $amount = $invoices->sum('amount');
        $discount_amount = $invoices->sum('discount_amount');

        $total = [
            'amount' => isset($amount) ? number_format($amount, 2) : 0,
            'discount_amount' => isset($discount_amount) ? number_format($discount_amount, 2) : 0
        ];

        return view('invoices.index', compact('invoices', 'total'));
    }

    public function create() {}

    public function store() {}

    public function show() {}

    public function edit() {}

    public function update() {}
}
