<?php

namespace App\Http\Controllers\API\Territory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Territory\CreateTerritoryRequest;
use App\Http\Requests\Territory\UpdateTerritoryRequest;
use App\Models\Territory;
use Illuminate\Http\Request;

class TerritoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index()
    {
        try {
            $data = Territory::with(['region', 'zone'])->get();

            return response()->json([
                'message' => 'Get all territories',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function store(CreateTerritoryRequest $request)
    {
        try {
            $data = Territory::create($request->validated());

            return response()->json([
                'message' => 'Territory created successfully',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $territory = Territory::with(['region', 'zone'])
                ->where('id', $id)
                ->orWhere('name', $id)
                ->first();

            if (empty($territory)) {
                return response()->json([
                    'message' => 'Territory does not exist'
                ], 422);
            }

            return response()->json([
                'message' => 'Get particular territory',
                'data' => $territory
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function update(UpdateTerritoryRequest $request, $id)
    {
        try {
            $territory = Territory::where('id', $id)->first();

            if (empty($territory)) {
                return response()->json([
                    'message' => 'Territory does not exist'
                ], 422);
            }

            $territory->update($request->validated());

            return response()->json([
                'message' => 'Territory updated successfully'
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
