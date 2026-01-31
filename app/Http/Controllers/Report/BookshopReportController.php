<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Zone;
use App\Models\Territory;
use App\Models\Registration;


class BookshopReportController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (!auth()->user()->can('reports.view')) {
                abort(403, 'Unauthorized action.');
            }

            $regions = Region::orderBy('name', 'ASC')->get();
            $zones = Zone::orderBy('name', 'ASC')->get();
            $territories = Territory::orderBy('name', 'ASC')->get();

            if (request()->ajax()) {

                if ($request->report_type == 1) {
                    $data = Registration::orderBy('created_at', 'DESC')
                        ->when(($request->filled('from_date') && $request->filled('to_date')), function ($query) use ($request) {
                            $query->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
                        })
                        ->when(!empty($request->user()->region_id), function ($query) use ($request) {
                            $query->where('region_id', $request->user()->region_id);
                        })
                        ->when($request->filled('region_id'), function ($query) use ($request) {
                            $query->where('region_id', $request->region_id);
                        })
                        ->when($request->filled('status'), function ($query) use ($request) {
                            $query->where('status', $request->status);
                        })
                        ->when($request->filled('zone_id'), function ($query) use ($request) {
                            $query->where('zone_id', $request->zone_id);
                        })
                        ->when($request->filled('territory_id'), function ($query) use ($request) {
                            $query->where('territory_id', $request->territory_id);
                        })
                        ->where('reg_type', 'bookshop')
                        ->get();

                    return datatables()->of($data)
                        ->addIndexColumn()
                        ->editColumn('created_by', function (Registration $school) {
                            return $school->createdBy->name ?? '';
                        })
                        ->editColumn('gps_location', function (Registration $school) {
                            return $school->latitude . ',' . $school->longitude;
                        })
                        ->editColumn('region', function (Registration $school) {
                            return $school->region->name ?? 'N/A';
                        })
                        ->editColumn('zone', function (Registration $school) {
                            return $school->zone->name ?? 'N/A';
                        })
                        ->editColumn('territory', function (Registration $school) {
                            return $school->territory->name ?? 'N/A';
                        })
                        ->editColumn('zonal_officer', function (Registration $school) {
                            return $school->zso->name ?? 'N/A';
                        })
                        ->editColumn('contact_person_name', function (Registration $school) {
                            return $school->contact_person_name ?? 'N/A';
                        })
                        ->editColumn('contact_person_phone', function (Registration $school) {
                            return $school->contact_person_phone ?? 'N/A';
                        })
                        ->editColumn('created_at', function (Registration $school) {
                            return $school->created_at;
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

            return view('reports.bookshop-report', compact('regions', 'zones', 'territories'));
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
