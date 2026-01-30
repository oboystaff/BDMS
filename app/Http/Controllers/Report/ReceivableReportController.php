<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;


class ReceivableReportController extends Controller
{
    public function index(Request $request)
    {
        try {
            // if (!auth()->user()->can('reports.view')) {
            //     abort(403, 'Unauthorized action.');
            // }

            if (request()->ajax()) {

                if ($request->report_type == 1) {
                    $invoiceTotals = DB::table('invoices')
                        ->when(($request->filled('from_date') && $request->filled('to_date')), function ($query) use ($request) {
                            $query->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
                        })
                        ->select('client_id', DB::raw('SUM(amount) as total_invoices'))
                        ->groupBy('client_id');

                    $paymentTotals = DB::table('payments')
                        ->when(($request->filled('from_date') && $request->filled('to_date')), function ($query) use ($request) {
                            $query->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
                        })
                        ->select('client_id', DB::raw('SUM(amount) as total_payments'))
                        ->groupBy('client_id');

                    $data = DB::table('registrations as r')
                        ->when(($request->filled('from_date') && $request->filled('to_date')), function ($query) use ($request) {
                            $query->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
                        })
                        ->leftJoinSub($invoiceTotals, 'i', 'r.reg_id', '=', 'i.client_id')
                        ->leftJoinSub($paymentTotals, 'p', 'r.reg_id', '=', 'p.client_id')
                        ->select(
                            'r.reg_id as client_id',
                            'r.name as client_name',
                            'r.phone as client_phone',
                            'r.email as client_email',
                            DB::raw('COALESCE(i.total_invoices, 0) as total_invoices'),
                            DB::raw('COALESCE(p.total_payments, 0) as total_payments'),
                            DB::raw('(COALESCE(i.total_invoices, 0) - COALESCE(p.total_payments, 0)) as amount_owed'),
                            DB::raw('CURDATE() as report_date')
                        )
                        ->whereRaw('(COALESCE(i.total_invoices, 0) - COALESCE(p.total_payments, 0)) > 0')
                        ->get();

                    return datatables()->of($data)
                        ->addIndexColumn()
                        ->editColumn('created_by', function ($row) {
                            //return $row->createdBy->name ?? '';
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

            return view('reports.receivable-report');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
