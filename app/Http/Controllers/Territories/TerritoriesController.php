<?php

namespace App\Http\Controllers\Territories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Territories\CreateTerritoriesRequest;
use App\Http\Requests\Territories\UpdateTerritoriesRequest;
use App\Models\Territory;
use App\Models\Zone;
use Illuminate\Http\Request;

class TerritoriesController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('territories.view')) {
            abort(403, 'Unauthorized action.');
        }

        $territories = Territory::orderBy('created_at', 'DESC')
            ->where('status', 'Active')
            ->get();

        return view('territories.index', compact('territories'));
    }

    public function create()
    {
        if (!auth()->user()->can('territories.create')) {
            abort(403, 'Unauthorized action.');
        }

        $zones = Zone::orderBy('name', 'ASC')
            ->where('status', 'Active')
            ->get();

        return view('territories.create', compact('zones'));
    }

    public function store(CreateTerritoriesRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        Territory::create($data);

        return redirect()->route('territories.index')->with('status', 'Territory created successfully.');
    }

    public function show(Territory $territory)
    {
        return view('territories.show', compact('territory'));
    }

    public function edit(Territory $territory)
    {
        if (!auth()->user()->can('territories.update')) {
            abort(403, 'Unauthorized action.');
        }

        $zones = Zone::orderBy('name', 'ASC')
            ->where('status', 'Active')
            ->get();

        return view('territories.edit', compact('territory', 'zones'));
    }

    public function update(UpdateTerritoriesRequest $request, Territory $territory)
    {
        $territory->update($request->validated());

        return redirect()->route('territories.index')->with('status', 'Territory updated successfully.');
    }
}
