<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\BookRequisition;
use Illuminate\Http\Request;

class BookRequisitionReportController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (!auth()->user()->can('reports.view')) {
                abort(403, 'Unauthorized action.');
            }


            if (request()->ajax()) {

                if ($request->report_type == 1) {
                    $data = BookRequisition::orderBy('created_at', 'DESC')
                        ->when(($request->filled('from_date') && $request->filled('to_date')), function ($query) use ($request) {
                            $query->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
                        })
                        ->when($request->filled('status'), function ($query) use ($request) {
                            $query->where('status', $request->status);
                        })
                        ->get();

                    return datatables()->of($data)
                        ->addIndexColumn()
                        ->editColumn('created_by', function (BookRequisition $requisition) {
                            return $requisition->createdBy->name ?? '';
                        })
                        ->editColumn('approved_by', function (BookRequisition $requisition) {
                            return $requisition->approvedBy->name ?? '';
                        })
                        ->editColumn('zonal_officer', function (BookRequisition $requisition) {
                            return $requisition->zso->name ?? 'N/A';
                        })
                        ->editColumn('subject', function (BookRequisition $requisition) {
                            return $requisition->subject->name ?? 'N/A';
                        })
                        ->editColumn('level', function (BookRequisition $requisition) {
                            return $requisition->level->name ?? 'N/A';
                        })
                        ->editColumn('created_date', function (BookRequisition $requisition) {
                            return $requisition->created_at;
                        })
                        ->editColumn('approved_date', function (BookRequisition $requisition) {
                            return $requisition->approved_date ?? 'N/A';
                        })
                        ->editColumn('pickup_date', function (BookRequisition $requisition) {
                            return $requisition->pickup_date ?? 'N/A';
                        })
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

            return view('reports.requisition-report');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
