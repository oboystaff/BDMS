<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;


class InventoryReportController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (!auth()->user()->can('reports.view')) {
                abort(403, 'Unauthorized action.');
            }


            if (request()->ajax()) {

                if ($request->report_type == 1) {
                    $data = Book::orderBy('created_at', 'DESC')
                        ->when(($request->filled('from_date') && $request->filled('to_date')), function ($query) use ($request) {
                            $query->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
                        })
                        ->when($request->filled('status'), function ($query) use ($request) {
                            $query->where('status', $request->status);
                        })
                        ->get();

                    return datatables()->of($data)
                        ->addIndexColumn()
                        ->editColumn('created_by', function (Book $book) {
                            return $book->createdBy->name ?? '';
                        })
                        ->editColumn('subject_name', function (Book $book) {
                            return $book->subject->name ?? 'N/A';
                        })
                        ->editColumn('level_name', function (Book $book) {
                            return $book->level->name ?? 'N/A';
                        })
                        ->editColumn('status', function (Book $book) {
                            $status = "";

                            if ($book->quantity > $book->minimum_stock_level) {
                                $status = '<span class="text-success fw-bold">In Stock</span>';
                            } else {
                                $status = '<span class="text-danger fw-bold">Low Stock</span>';
                            }

                            return $status;
                        })
                        ->editColumn('created_at', function (Book $book) {
                            return $book->created_at;
                        })
                        ->rawColumns(['status'])
                        ->make(true);
                } else {
                    $data = DB::table('sales as s')
                        ->when(($request->filled('from_date') && $request->filled('to_date')), function ($query) use ($request) {
                            $query->whereBetween('s.created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
                        })
                        ->when(!empty($request->user()->branch_id), function ($query) use ($request) {
                            return $query->where('s.branch_id', $request->user()->branch_id);
                        })
                        ->when($request->filled('user_id'), function ($query) use ($request) {
                            return $query->where('s.created_by', $request->input('user_id'));
                        })
                        ->join('users as u', 's.created_by', '=', 'u.id')
                        ->select(
                            'u.id',
                            'u.name',
                            DB::raw('SUM(s.amount) as total_sold')
                        )
                        ->groupBy('u.id', 'u.name')
                        ->get();


                    return datatables()->of($data)
                        ->addIndexColumn()
                        ->make(true);
                }
            }

            return view('reports.inventory-report');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
