<?php

namespace App\Http\Controllers\BookReturn;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookReturn\CreateBookReturnRequest;
use App\Models\BookRequisition;
use App\Models\BookReturn;
use App\Models\Book;
use App\Models\ZonalSalesOfficer;
use Illuminate\Http\Request;

class BookReturnController extends Controller
{
    public function index()
    {
        $bookReturns = BookReturn::orderBy('created_at', 'DESC')->get();

        return view('returns.index', compact('bookReturns'));
    }

    public function create(BookRequisition $requisition)
    {
        $book = Book::where('subject_id', $requisition->subject_id)
            ->where('level_id', $requisition->level_id)
            ->first();

        $zso = ZonalSalesOfficer::where('id', $requisition->zonal_sales_officer_id)->first();

        return view('returns.create', compact('requisition', 'book', 'zso'));
    }

    public function store(CreateBookReturnRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        if ((float) $data['quantity'] > (float) $data['quantity_requested']) {
            return redirect()->route('book-returns.index')->with('error', 'The returned quantity cannot be greater than the requested quantity');
        }

        $returnData = [
            'req_id' => $data['req_id'],
            'zonal_sales_officer_id' => $data['zonal_sales_officer_id'],
            'book_id' => $data['book_id'],
            'quantity' => $data['quantity'],
            'reason' => $data['reason'],
            'received_by' => $request->user()->id,
            'created_by' => $request->input('created_by')
        ];

        $bookReturn = BookReturn::create($returnData);
        $bookUpdateResp = null;

        if ($bookReturn) {
            $book = Book::where('book_id', $data['book_id'])->first();
            $newBookQuantity = (float) $book->quantity + (float) $data['quantity'];

            $bookData = [
                'quantity' => $newBookQuantity
            ];

            $bookUpdateResp = $book->update($bookData);
        }

        if ($bookUpdateResp > 0) {
            $requisition = BookRequisition::where('id', $data['req_id'])->first();
            $newQuantity = (float) $requisition->quantity - (float) $data['quantity'];
            $newAmount = (float) $request->input('unit_price') * $newQuantity;

            $requisitionData = [
                'quantity' => $newQuantity,
                'amount' => $newAmount
            ];

            $requisition->update($requisitionData);
        }

        return redirect()->route('book-returns.index')->with('status', 'Book return received successfully.');
    }

    public function show(BookReturn $bookReturn)
    {
        $book = Book::where('subject_id', $bookReturn->requisition->subject_id)
            ->where('level_id', $bookReturn->requisition->level_id)
            ->first();

        $zso = ZonalSalesOfficer::where('id', $bookReturn->zonal_sales_officer_id)->first();

        return view('returns.show', compact('bookReturn', 'book', 'zso'));
    }

    public function edit() {}

    public function update() {}

    public function requisition(Request $request)
    {
        $requisitions = BookRequisition::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->zso_id), function ($query) use ($request) {
                $query->where('created_by', $request->user()->id);
            })
            ->where('status', 'Approved')
            ->where('quantity', '>', 0)
            ->get();

        return view('returns.requisition', compact('requisitions'));
    }
}
