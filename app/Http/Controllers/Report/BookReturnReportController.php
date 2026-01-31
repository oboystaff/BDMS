<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\BookReturn;
use Illuminate\Http\Request;

class BookReturnReportController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (!auth()->user()->can('reports.view')) {
                abort(403, 'Unauthorized action.');
            }


            if (request()->ajax()) {

                if ($request->report_type == 1) {
                    $data = BookReturn::orderBy('created_at', 'DESC')
                        ->when(($request->filled('from_date') && $request->filled('to_date')), function ($query) use ($request) {
                            $query->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
                        })
                        ->when($request->filled('status'), function ($query) use ($request) {
                            $query->where('status', $request->status);
                        })
                        ->get();

                    return datatables()->of($data)
                        ->addIndexColumn()
                        ->editColumn('received_by', function (BookReturn $bookReturn) {
                            return $bookReturn->createdBy->name ?? '';
                        })
                        ->editColumn('zonal_officer', function (BookReturn $bookReturn) {
                            return $bookReturn->zso->name ?? 'N/A';
                        })
                        ->editColumn('subject', function (BookReturn $bookReturn) {
                            return $bookReturn->requisition->subject->name ?? 'N/A';
                        })
                        ->editColumn('level', function (BookReturn $bookReturn) {
                            return $bookReturn->requisition->level->name ?? 'N/A';
                        })
                        ->editColumn('received_date', function (BookReturn $bookReturn) {
                            return $bookReturn->created_at;
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

            return view('reports.return-report');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
