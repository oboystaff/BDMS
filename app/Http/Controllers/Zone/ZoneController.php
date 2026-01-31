<?php

namespace App\Http\Controllers\Zone;

use App\Http\Controllers\Controller;
use App\Http\Requests\Zone\CreateZoneRequest;
use App\Http\Requests\Zone\UpdateZoneRequest;
use App\Models\ZonalSalesOfficer;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('zones.view')) {
            abort(403, 'Unauthorized action.');
        }

        $zones = Zone::orderBy('created_at', 'DESC')->get();

        return view('zones.index', compact('zones'));
    }

    public function create()
    {
        if (!auth()->user()->can('zones.create')) {
            abort(403, 'Unauthorized action.');
        }

        $zonalSalesOfficers = ZonalSalesOfficer::orderBy('name', 'ASC')
            ->where('status', 'Active')
            ->get();

        return view('zones.create', compact('zonalSalesOfficers'));
    }

    public function store(CreateZoneRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        Zone::create($data);

        return redirect()->route('zones.index')->with('status', 'Zone created successfully.');
    }

    public function show(Zone $zone)
    {
        return view('zones.show', compact('zone'));
    }

    public function edit(Zone $zone)
    {
        if (!auth()->user()->can('zones.update')) {
            abort(403, 'Unauthorized action.');
        }

        $zonalSalesOfficers = ZonalSalesOfficer::orderBy('name', 'ASC')
            ->where('status', 'Active')
            ->get();

        return view('zones.edit', compact('zone', 'zonalSalesOfficers'));
    }

    public function update(UpdateZoneRequest $request, Zone $zone)
    {
        $zone->update($request->validated());

        return redirect()->route('zones.index')->with('status', 'Zone updated successfully.');
    }
}
