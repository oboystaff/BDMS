<?php

namespace App\Http\Controllers\ZonalSalesOfficer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ZonalSalesOfficer\CreateZonalSalesOfficerRequest;
use App\Http\Requests\ZonalSalesOfficer\UpdateZonalSalesOfficerRequest;
use App\Models\ZonalSalesOfficer;
use Illuminate\Http\Request;

class ZonalSalesOfficerController extends Controller
{
    public function index()
    {
        $zonalSalesOfficers = ZonalSalesOfficer::orderBy('created_at', 'DESC')->get();

        return view('zonal-sales-officers.index', compact('zonalSalesOfficers'));
    }

    public function create()
    {
        return view('zonal-sales-officers.create');
    }

    public function store(CreateZonalSalesOfficerRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        ZonalSalesOfficer::create($data);

        return redirect()->route('zonal-sales-officers.index')->with('status', 'Zonal sales officer created successfully.');
    }

    public function show(ZonalSalesOfficer $zonalSalesOfficer)
    {
        return view('zonal-sales-officers.show', compact('zonalSalesOfficer'));
    }

    public function edit(ZonalSalesOfficer $zonalSalesOfficer)
    {
        return view('zonal-sales-officers.edit', compact('zonalSalesOfficer'));
    }

    public function update(UpdateZonalSalesOfficerRequest $request, ZonalSalesOfficer $zonalSalesOfficer)
    {
        $zonalSalesOfficer->update($request->validated());

        return redirect()->route('zonal-sales-officers.index')->with('status', 'Zonal sales officer updated successfully.');
    }
}
