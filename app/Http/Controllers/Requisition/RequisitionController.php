<?php

namespace App\Http\Controllers\Requisition;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requisition\CreateRequisitionRequest;
use App\Models\Book;
use App\Models\BookRequisition;
use App\Models\Subject;
use App\Models\Level;
use App\Models\ZonalSalesOfficer;
use Illuminate\Http\Request;


class RequisitionController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('requisitions.view')) {
            abort(403, 'Unauthorized action.');
        }

        $requisitions = BookRequisition::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->zso_id), function ($query) use ($request) {
                $query->where('created_by', $request->user()->id);
            })
            ->get();

        return view('requisitions.index', compact('requisitions'));
    }

    public function create(Request $request, Book $book)
    {
        if (!auth()->user()->can('requisitions.create')) {
            abort(403, 'Unauthorized action.');
        }

        $subjects = Subject::orderBy('name', 'ASC')->get();
        $levels = Level::orderBy('name', 'ASC')->get();
        $user = $request->user();

        $zso = ZonalSalesOfficer::where('id', $user->zso_id)->first();

        return view('requisitions.create', compact('subjects', 'levels', 'book', 'zso'));
    }

    public function store(CreateRequisitionRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $totalAmount = (float) $data['quantity'] * (float) $data['unit_price'];
        $data['amount'] = $totalAmount ?? 0;
        $data['status'] = "Pending";

        if ((float) $data['quantity'] > (float) $data['available_stock']) {
            return redirect()->route('requisitions.index-book')->with('error', 'The requested quantity cannot be greater than the available stock');
        }

        $pendingRequeust = BookRequisition::where('subject_id', $data['subject_id'])
            ->where('level_id', $data['level_id'])
            ->where('status', 'Pending')
            ->first();

        if (!empty($pendingRequeust)) {
            return redirect()->route('requisitions.index')->with('error', 'You have pending requisition for the selected subject and level');
        }

        BookRequisition::create($data);

        return redirect()->route('requisitions.index')->with('status', 'Requisition created successfully.');
    }

    public function show(BookRequisition $requisition)
    {
        $book = Book::where('subject_id', $requisition->subject_id)
            ->where('level_id', $requisition->level_id)
            ->first();

        $zso = ZonalSalesOfficer::where('id', $requisition->zonal_sales_officer_id)->first();

        return view('requisitions.show', compact('requisition', 'book', 'zso'));
    }

    public function edit() {}

    public function update() {}

    public function index_book()
    {
        $books = Book::orderBy('created_at', 'DESC')->get();

        return view('requisitions.index_book', compact('books'));
    }

    public function approve(BookRequisition $requisition)
    {
        $book = Book::where('subject_id', $requisition->subject_id)
            ->where('level_id', $requisition->level_id)
            ->first();

        $zso = ZonalSalesOfficer::where('id', $requisition->zonal_sales_officer_id)->first();

        return view('requisitions.approve', compact('requisition', 'book', 'zso'));
    }

    public function approveData(Request $request, BookRequisition $requisition)
    {
        $action = $request->input('action');
        $message = '';

        if ($action === 'approve') {
            $message = 'Requisition request approved successfully.';

            $oldQuantity = (float) $request->input('available_stock');
            $requestQuantity = (float) $request->input('quantity');

            if ($requestQuantity > $oldQuantity) {
                return redirect()->route('requisitions.index')->with('error', 'The requested quantity cannot be greater than the available stock');
            }

            $newQuantity = $oldQuantity - $requestQuantity;

            $bookData = [
                'quantity' => $newQuantity
            ];

            $requisitionData = [
                'status' => 'Approved',
                'approved_by' => $request->user()->id,
                'approved_date' => now()
            ];

            Book::where('book_id', $requisition->book_id)->update($bookData);
            BookRequisition::where('id', $requisition->id)->update($requisitionData);
        } elseif ($action === 'reject') {
            $message = 'Requisition request rejected successfully.';

            $requisitionData = [
                'status' => 'Rejected',
                'approved_by' => $request->user()->id,
                'approved_date' => now()
            ];

            BookRequisition::where('id', $requisition->id)->update($requisitionData);
        }

        return redirect()->route('requisitions.index')->with('status', $message);
    }

    public function pickup(BookRequisition $requisition)
    {
        $book = Book::where('subject_id', $requisition->subject_id)
            ->where('level_id', $requisition->level_id)
            ->first();

        $zso = ZonalSalesOfficer::where('id', $requisition->zonal_sales_officer_id)->first();

        return view('requisitions.edit', compact('requisition', 'book', 'zso'));
    }

    public function pickupData(BookRequisition $requisition)
    {
        $requisitionData = [
            'pickup_date' => now()
        ];

        $requisition->update($requisitionData);

        return redirect()->route('requisitions.index')->with('status', 'Requisition request pickup successfully.');
    }
}
