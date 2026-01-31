<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ClientRequest;
use App\Models\Registration;
use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function operational(Request $request)
    {
        if (!auth()->user()->can('dashboards.operational')) {
            abort(403, 'Unauthorized action.');
        }

        $totalSchool = Registration::where('reg_type', 'school')->count();
        $activeSchool = Registration::where('reg_type', 'school')->where('status', 'Active')->count();
        $inactiveSchool = Registration::where('reg_type', 'school')->where('status', 'InActive')->count();

        $totalBookshop = Registration::where('reg_type', 'bookshop')->count();
        $activeBookshop = Registration::where('reg_type', 'bookshop')->where('status', 'Active')->count();
        $inactiveBookshop = Registration::where('reg_type', 'bookshop')->where('status', 'InActive')->count();

        $pendingRequest = ClientRequest::where('status', 'Pending')->count();

        $weeklyRequest = ClientRequest::query()
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ])->count();

        $monthlyRequest = ClientRequest::query()
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $yearlyRequest = ClientRequest::query()
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $total = [
            'totalSchool' => $totalSchool ?? 0,
            'activeSchool' => $activeSchool ?? 0,
            'inactiveSchool' => $inactiveSchool ?? 0,
            'totalBookshop' => $totalBookshop ?? 0,
            'activeBookshop' => $activeBookshop ?? 0,
            'inactiveBookshop' => $inactiveBookshop ?? 0,
            'pendingRequest' => $pendingRequest ?? 0,
            'weeklyRequest' => $weeklyRequest ?? 0,
            'monthlyRequest' => $monthlyRequest ?? 0,
            'yearlyRequest' => $yearlyRequest ?? 0
        ];

        return view('dashboard.operational', compact('total'));
    }

    public function financial()
    {
        if (!auth()->user()->can('dashboards.financial')) {
            abort(403, 'Unauthorized action.');
        }

        $dailyPayments = Payment::whereDate('created_at', Carbon::today())
            ->sum('amount');

        $weeklyPayments = Payment::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])
            ->sum('amount');

        $monthlyPayments = Payment::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');

        $yearlyPayments = Payment::whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $dailyInvoices = Invoice::whereDate('created_at', Carbon::today())
            ->sum('amount');

        $weeklyInvoices = Invoice::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])
            ->sum('amount');

        $monthlyInvoices = Invoice::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');

        $yearlyInvoices = Invoice::whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $dailyReceivables   = max(0, $dailyInvoices   - $dailyPayments);
        $weeklyReceivables  = max(0, $weeklyInvoices  - $weeklyPayments);
        $monthlyReceivables = max(0, $monthlyInvoices - $monthlyPayments);
        $yearlyReceivables  = max(0, $yearlyInvoices  - $yearlyPayments);

        $total = [
            'dailyPayments' => isset($dailyPayments) ? number_format($dailyPayments, 2) : 0,
            'weeklyPayments' => isset($weeklyPayments) ? number_format($weeklyPayments, 2) : 0,
            'monthlyPayments' => isset($monthlyPayments) ? number_format($monthlyPayments, 2) : 0,
            'yearlyPayments' => isset($yearlyPayments) ? number_format($yearlyPayments, 2) : 0,
            'dailyInvoices' => isset($dailyInvoices) ? number_format($dailyInvoices, 2) : 0,
            'weeklyInvoices' => isset($weeklyInvoices) ? number_format($weeklyInvoices, 2) : 0,
            'monthlyInvoices' => isset($monthlyInvoices) ? number_format($monthlyInvoices, 2) : 0,
            'yearlyInvoices' => isset($yearlyInvoices) ? number_format($yearlyInvoices, 2) : 0,
            'dailyReceivables' => isset($dailyReceivables) ? number_format($dailyReceivables, 2) : 0,
            'weeklyReceivables' => isset($weeklyReceivables) ? number_format($weeklyReceivables, 2) : 0,
            'monthlyReceivables' => isset($monthlyReceivables) ? number_format($monthlyReceivables, 2) : 0,
            'yearlyReceivables' => isset($yearlyReceivables) ? number_format($yearlyReceivables, 2) : 0
        ];

        return view('dashboard.financial', compact('total'));
    }

    public function receivable(Request $request)
    {
        $invoiceTotals = DB::table('invoices')
            ->when($request->display == "daily", function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->when($request->display == "weekly", function ($query) {
                $query->whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            })
            ->when($request->display == "monthly", function ($query) {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            })
            ->when($request->display == "yearly", function ($query) {
                $query->whereYear('created_at', Carbon::now()->year);
            })
            ->select('client_id', DB::raw('SUM(amount) as total_invoices'))
            ->groupBy('client_id');

        $paymentTotals = DB::table('payments')
            ->when($request->display == "daily", function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->when($request->display == "weekly", function ($query) {
                $query->whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            })
            ->when($request->display == "monthly", function ($query) {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            })
            ->when($request->display == "yearly", function ($query) {
                $query->whereYear('created_at', Carbon::now()->year);
            })
            ->select('client_id', DB::raw('SUM(amount) as total_payments'))
            ->groupBy('client_id');

        $receivables = DB::table('registrations as r')
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

        $amount = $receivables->sum('amount_owed');

        $total = [
            'amount' => isset($amount) ? number_format($amount, 2) : 0
        ];

        return view('dashboard.receivable', compact('receivables', 'total'));
    }
}
