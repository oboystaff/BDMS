<?php

namespace App\Http\Controllers\Bookshop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bookshop\CreateBookshopRequest;
use App\Http\Requests\Bookshop\UpdateBookshopRequest;
use App\Models\Registration;
use App\Models\Region;
use App\Models\Zone;
use App\Models\Territory;
use App\Models\ZonalSalesOfficer;
use Illuminate\Http\Request;


class BookshopController extends Controller
{
    public function index(Request $request)
    {
        $bookshops = Registration::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->region_id), function ($query) use ($request) {
                $query->where('region_id', $request->user()->region_id);
            })
            ->when($request->display == "active", function ($query) {
                $query->where('status', 'Active');
            })
            ->when($request->display == "inactive", function ($query) {
                $query->where('status', 'InActive');
            })
            ->where('reg_type', 'bookshop')
            ->get();

        return view('bookshops.index', compact('bookshops'));
    }

    public function create(Request $request)
    {
        $regions = Region::orderBy('name', 'ASC')
            ->when(!empty($request->user()->region_id), function ($query) use ($request) {
                $query->where('id', $request->user()->region_id);
            })
            ->get();

        $zones = Zone::orderBy('name', 'ASC')->where('status', 'Active')->get();
        $territories = Territory::orderBy('name', 'ASC')->where('status', 'Active')->get();
        $zonalSalesOfficers = ZonalSalesOfficer::orderBy('name', 'ASC')
            ->when(!empty($request->user()->zso_id), function ($query) use ($request) {
                $query->where('created_by', $request->user()->id);
            })
            ->where('status', 'Active')
            ->get();

        return view('bookshops.create', compact('regions', 'regions', 'zones', 'territories', 'zonalSalesOfficers'));
    }

    public function store(CreateBookshopRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['reg_type'] = 'bookshop';

        Registration::create($data);

        return redirect()->route('bookshops.index')->with('status', 'Bookshop created successfully.');
    }

    public function show(Registration $bookshop)
    {
        return view('bookshops.show', compact('bookshop'));
    }

    public function edit(Request $request, Registration $bookshop)
    {
        $regions = Region::orderBy('name', 'ASC')
            ->when(!empty($request->user()->region_id), function ($query) use ($request) {
                $query->where('id', $request->user()->region_id);
            })
            ->get();

        $zones = Zone::orderBy('name', 'ASC')->where('status', 'Active')->get();
        $territories = Territory::orderBy('name', 'ASC')->where('status', 'Active')->get();
        $zonalSalesOfficers = ZonalSalesOfficer::orderBy('name', 'ASC')
            ->when(!empty($request->user()->zso_id), function ($query) use ($request) {
                $query->where('created_by', $request->user()->id);
            })
            ->where('status', 'Active')
            ->get();

        return view('bookshops.edit', compact('bookshop', 'regions', 'zones', 'territories', 'zonalSalesOfficers'));
    }

    public function update(UpdateBookshopRequest $request, Registration $bookshop)
    {
        $bookshop->update($request->validated());

        return redirect()->route('bookshops.index')->with('status', 'Bookshop record updated successfully.');
    }
}
