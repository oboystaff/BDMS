<?php

namespace App\Http\Controllers\API\Region;

use App\Http\Controllers\Controller;
use App\Http\Requests\Region\CreateRegionRequest;
use App\Http\Requests\Region\UpdateRegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index()
    {
        try {
            $data = Region::with(['zone'])->get();

            return response()->json([
                'message' => 'Get all regions',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function store(CreateRegionRequest $request)
    {
        try {
            $region = Region::create($request->validated());

            return response()->json([
                'message' => 'Region created successfully',
                'data' => $region
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $region = Region::with(['zone'])->where('id', $id)->first();

            if (empty($region)) {
                return response()->json([
                    'message' => 'Region does not exist'
                ], 422);
            }

            return response()->json([
                'message' => 'Get particular region',
                'data' => $region
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function update(UpdateRegionRequest $request, $id)
    {
        try {
            $region = Region::where('id', $id)->first();

            if (empty($region)) {
                return response()->json([
                    'message' => 'Region does not exist'
                ], 422);
            }

            $region->update($request->validated());

            return response()->json([
                'message' => 'Region updated successfully'
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
