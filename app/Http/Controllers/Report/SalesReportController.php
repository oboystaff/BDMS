<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        try {
            // if (!auth()->user()->can('reports.view')) {
            //     abort(403, 'Unauthorized action.');
            // }


            if (request()->ajax()) {

                if ($request->report_type == 1) {
                    $data = Sale::orderBy('created_at', 'DESC')
                        ->when(($request->filled('from_date') && $request->filled('to_date')), function ($query) use ($request) {
                            $query->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
                        })
                        ->when($request->filled('status'), function ($query) use ($request) {
                            $query->where('status', $request->status);
                        })
                        ->get();

                    return datatables()->of($data)
                        ->addIndexColumn()
                        ->editColumn('created_by', function (Sale $sale) {
                            return $sale->createdBy->name ?? '';
                        })
                        ->editColumn('client_name', function (Sale $sale) {
                            return $sale->client->name ?? 'N/A';
                        })
                        ->editColumn('subject', function (Sale $sale) {
                            return $sale->clientRequest->subject->name ?? 'N/A';
                        })
                        ->editColumn('level', function (Sale $sale) {
                            return $sale->clientRequest->level->name ?? 'N/A';
                        })
                        ->editColumn('zonal_officer', function (Sale $sale) {
                            return $sale->zso->name ?? 'N/A';
                        })
                        ->editColumn('unit_price', function (Sale $sale) {
                            return $sale->clientRequest->unit_price ?? 0;
                        })
                        ->editColumn('quantity', function (Sale $sale) {
                            return $sale->clientRequest->quantity ?? 0;
                        })
                        ->editColumn('created_at', function (Sale $sale) {
                            return $sale->created_at;
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

            return view('reports.sales-report');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
