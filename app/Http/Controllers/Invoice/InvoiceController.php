<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::orderBy('created_at', 'DESC')->get();

        return view('invoices.index', compact('invoices'));
    }

    public function create() {}

    public function store() {}

    public function show() {}

    public function edit() {}

    public function update() {}
}
