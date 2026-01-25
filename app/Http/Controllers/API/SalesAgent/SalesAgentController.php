<?php

namespace App\Http\Controllers\API\SalesAgent;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalesAgent\CreateSalesAgentRequest;
use App\Http\Requests\SalesAgent\UpdateSalesAgentRequest;
use App\Models\SalesAgent;
use App\Models\User;
use Illuminate\Http\Request;

class SalesAgentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index()
    {
        try {
            $data = SalesAgent::with(['territory.region'])->get();

            return response()->json([
                'message' => 'Get all sales agents',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function store(CreateSalesAgentRequest $request)
    {
        try {
            $data = SalesAgent::create($request->validated());

            if (!empty($data)) {
                $userData = [
                    'name' => $data->name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                    'region_id' => $data->territory->region->id ?? '',
                    'password' => env('DEFAULT_PASSWORD')
                ];

                User::create($userData);
            }

            return response()->json([
                'message' => 'Sales agent created successfully',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $salesAgent = SalesAgent::with(['territory.region'])
                ->where('id', $id)
                ->orWhere('agent_id', $id)
                ->first();

            if (empty($salesAgent)) {
                return response()->json([
                    'message' => 'Sales agent not found'
                ], 422);
            }

            return response()->json([
                'message' => 'Get particular sales agent',
                'data' => $salesAgent
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function update(UpdateSalesAgentRequest $request, $id)
    {
        try {
            $salesAgent = SalesAgent::where('id', $id)
                ->orWhere('agent_id', $id)
                ->first();

            if (empty($salesAgent)) {
                return response()->json([
                    'message' => 'Sales agent not found'
                ], 422);
            }

            $user = User::where('phone', $salesAgent->phone)->first();

            $salesAgent->update($request->validated());

            if (!empty($user)) {
                $user->update([
                    'name' => $request->validated('name'),
                    'phone' => $request->validated('phone'),
                    'email' => $request->validated('email')
                ]);
            }

            return response()->json([
                'message' => 'Sales agent updated successfully',
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
