<?php

namespace App\Http\Controllers\Zone;

use App\Http\Controllers\Controller;
use App\Http\Requests\Zone\CreateZoneRequest;
use App\Http\Requests\Zone\UpdateZoneRequest;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index()
    {
        try {
            $data = Zone::get();

            return response()->json([
                'message' => 'Get all zones',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function store(CreateZoneRequest $request)
    {
        try {
            $data = Zone::create($request->validated());

            return response()->json([
                'message' => 'Zone created successfully',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $zone = Zone::where('id', $id)->first();

            if (empty($zone)) {
                return response()->json([
                    'message' => 'Zone does not exist'
                ], 422);
            }

            return response()->json([
                'message' => 'Get particular zone',
                'data' => $zone
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function update(UpdateZoneRequest $request, $id)
    {
        try {
            $zone = Zone::where('id', $id)->first();

            if (empty($zone)) {
                return response()->json([
                    'message' => 'Zone does not exist'
                ], 422);
            }

            $zone->update($request->validated());

            return response()->json([
                'message' => 'Zone updated successfully'
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
