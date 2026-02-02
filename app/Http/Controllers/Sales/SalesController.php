<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\CreateInvoiceRequest;
use App\Http\Requests\Sales\CreateSalesRequest;
use App\Models\Book;
use App\Models\ClientRequest;
use App\Models\Invoice;
use App\Models\Sale;
use App\Models\ZonalSalesOfficer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $userId = $request->user()->id;

        $salesCount = 0;

        try {
            DB::transaction(function () use ($data, $userId, &$salesCount) {

                $clientRequests = ClientRequest::where('request_id', $data['request_id'])->get();

                if ($clientRequests->isEmpty()) {
                    return redirect()->route('sales.client_request')->with('error', 'No client requests found for this request.');
                }

                foreach ($clientRequests as $clientRequest) {

                    $book = Book::where('book_id', $clientRequest->book_id)->firstOrFail();

                    if ($clientRequest->quantity > $book->quantity) {
                        return redirect()->route('sales.client_request')->with('error', 'Requested quantity for {$book->title} exceeds available stock.');
                    }

                    Sale::create([
                        'request_id'             => $clientRequest->request_id,
                        'client_id'              => $clientRequest->client_id,
                        'book_id'                => $clientRequest->book_id,
                        'unit_price'             => $clientRequest->unit_price,
                        'quantity'               => $clientRequest->quantity,
                        'amount'                 => $clientRequest->amount,
                        'zonal_sales_officer_id' => $data['zonal_sales_officer_id'],
                        'created_by'             => $userId,
                    ]);

                    $salesCount++;

                    $book->update([
                        'quantity' => $book->quantity - $clientRequest->quantity
                    ]);

                    $clientRequest->update([
                        'status' => 'Completed'
                    ]);
                }
            });
        } catch (\Exception $e) {
            return redirect()
                ->route('sales.client_request')
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('sales.index')
            ->with('status', "Sales created successfully. Total items sold: {$salesCount}");
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

    public function confirm_data(CreateInvoiceRequest $request, Sale $sale)
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

        if ($request->apply_discount == 1) {
            $invoiceData['discount'] = $request->input('discount');
            $invoiceData['discount_amount'] = $request->input('discount_amount');
            $invoiceData['amount'] = (float)$invoiceData['amount'] - (float) $invoiceData['discount_amount'];
        }

        $invoice = Invoice::create($invoiceData);

        return redirect()->route('invoices.index')->with('status', 'Sales distribution confirmed & Invoice created successfully.');
    }
}
