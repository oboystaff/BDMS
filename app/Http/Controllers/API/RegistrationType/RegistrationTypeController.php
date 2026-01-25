<?php

namespace App\Http\Controllers\API\RegistrationType;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationType\CreateRegistrationTypeRequest;
use App\Http\Requests\RegistrationType\UpdateRegistrationTypeRequest;
use App\Models\RegistrationType;
use Illuminate\Http\Request;

class RegistrationTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index()
    {
        try {
            $data = RegistrationType::get();

            return response()->json([
                'message' => 'Get all registration types',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function store(CreateRegistrationTypeRequest $request)
    {
        try {
            $data = RegistrationType::create($request->validated());

            return response()->json([
                'message' => 'Registration type created successfully',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $registrationType = RegistrationType::where('id', $id)
                ->orwhere('name', $id)
                ->first();

            if (empty($registrationType)) {
                return response()->json([
                    'message' => 'Registration type not found'
                ], 422);
            }

            return response()->json([
                'message' => 'Get particular registration type',
                'data' => $registrationType
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function update(UpdateRegistrationTypeRequest $request, $id)
    {
        try {
            $registrationType = RegistrationType::where('id', $id)
                ->orwhere('name', $id)
                ->first();

            if (empty($registrationType)) {
                return response()->json([
                    'message' => 'Registration type not found'
                ], 422);
            }

            $registrationType->update($request->validated());

            return response()->json([
                'message' => 'Registration type updated successfully'
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
