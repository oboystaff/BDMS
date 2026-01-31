<?php

namespace App\Http\Controllers\API\ClientRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ClientRequest\CreateClientRequest;
use App\Models\ClientRequest;
use Illuminate\Http\Request;

class ClientRequestController extends Controller
{
    public function index()
    {
        $data = ClientRequest::orderBy('created_at', 'DESC')
            ->with(['subject', 'level', 'client'])
            ->get();

        return response()->json([
            'message' => 'Get all client requests',
            'data' => $data
        ]);
    }

    public function store(CreateClientRequest $request)
    {
        $data = $request->validated();
        $data['request_id'] = $this->generateRequestId();
        $data['created_by'] = $request->user()->id;
        $data['status'] = 'Pending';

        $requestExist = ClientRequest::where('client_id', $data['client_id'])
            ->where('status', 'Pending')
            ->first();

        if (!empty($requestExist)) {
            return response()->json([
                'message' => 'Client already has a pending request, contact the admin'
            ], 422);
        }

        $clientRequest = ClientRequest::create($data);

        return response()->json([
            'message' => 'Client request submitted successfully',
            'data' => $clientRequest
        ]);
    }

    public function show($id)
    {
        $clientRequest = ClientRequest::with(['subject', 'level', 'client'])
            ->where('id', $id)
            ->first();

        if (empty($clientRequest)) {
            return response()->json([
                'message' => 'Client request not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particular client request',
            'data' => $clientRequest
        ]);
    }

    public function update() {}

    private function generateRequestId()
    {
        do {
            $requestId = rand(10000000, 99999999);
        } while (ClientRequest::where('request_id', $requestId)->exists());

        return $requestId;
    }
}
