<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sales\CreateSalesRequest;
use App\Models\Book;
use App\Models\ClientRequest;
use App\Models\Invoice;
use App\Models\Sale;
use App\Models\ZonalSalesOfficer;
use Illuminate\Http\Request;


class SalesController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('sales.view')) {
            abort(403, 'Unauthorized action.');
        }

        $sales = Sale::orderBy('created_at', 'DESC')->get();

        return view('sales.index', compact('sales'));
    }

    public function create() {}

    public function store(CreateSalesRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $salesData = [
            'request_id' => $data['request_id'],
            'client_id' => $data['client_id'],
            'book_id' => $data['book_id'],
            'amount' => $data['amount'],
            'zonal_sales_officer_id' => $data['zonal_sales_officer_id'],
            'created_by' => $data['created_by']
        ];

        if ((float) $request->input('quantity') > (float) $request->input('available_stock')) {
            return redirect()->route('sales.client_request')->with('error', 'Book request cannot be greater than the available stock, check and try again');
        }

        $sales = Sale::create($salesData);

        if (!empty($sales)) {
            $clientRequest = ClientRequest::where('request_id', $data['request_id'])->first();
            $book = Book::where('book_id', $data['book_id'])->first();

            $clientRequestData = [
                'status' => 'Completed'
            ];

            $clientRequest->update($clientRequestData);

            $currentQuantity = (float) $book->quantity;
            $requestQuantity = (float) $clientRequest->quantity;
            $newQuantity = $currentQuantity - $requestQuantity;

            $bookData = [
                'quantity' => $newQuantity
            ];

            $book->update($bookData);
        }

        return redirect()->route('sales.index')->with('status', 'Book sale created successfully.');
    }

    public function show(Sale $sale)
    {
        $clientRequest = ClientRequest::where('request_id', $sale->request_id)->first();

        return view('sales.show', compact('sale', 'clientRequest'));
    }

    public function edit() {}

    public function update() {}

    public function client_request()
    {
        $clientRequests = ClientRequest::orderBy('created_at', 'DESC')
            ->whereNotNull('book_id')
            ->whereNotNull('subject_id')
            ->whereNotNull('level_id')
            ->get();

        return view('sales.client-request', compact('clientRequests'));
    }

    public function make_sales(Request $request, ClientRequest $clientRequest)
    {
        $zonalSalesOfficers = ZonalSalesOfficer::orderBy('name', 'ASC')
            ->when(!empty($request->user()->zso_id), function ($query) use ($request) {
                $query->where('created_by', $request->user()->id);
            })
            ->where('status', 'Active')
            ->get();

        return view('sales.make-sales', compact('clientRequest', 'zonalSalesOfficers'));
    }

    public function confirm_distribution(Sale $sale)
    {
        $clientRequest = ClientRequest::where('request_id', $sale->request_id)->first();

        return view('sales.create', compact('sale', 'clientRequest'));
    }

    public function confirm_data(Request $request, Sale $sale)
    {
        $saleData = [
            'status' => 'Completed'
        ];

        $sale->update($saleData);

        $invoiceData = [
            'sales_id' => $request->input('sales_id'),
            'client_id' => $request->input('client_id'),
            'book_id' => $request->input('book_id'),
            'unit_price' => $request->input('unit_price'),
            'quantity' => $request->input('quantity'),
            'amount' => $request->input('amount'),
            'created_by' => $request->user()->id
        ];

        $invoice = Invoice::create($invoiceData);

        return redirect()->route('invoices.index')->with('status', 'Sales distribution confirmed & Invoice created successfully.');
    }
}
