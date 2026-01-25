<?php

namespace App\Http\Controllers\API\UserType;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserType\CreateUserTypeRequest;
use App\Http\Requests\UserType\UpdateUserTypeRequest;
use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    public function __construct() {}

    public function index()
    {
        try {
            $data = UserType::get();

            return response()->json([
                'message' => 'Get all user types',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function store(CreateUserTypeRequest $request)
    {
        try {
            $userType = UserType::create($request->validated());

            return response()->json([
                'message' => 'User type created successfully',
                'data' => $userType
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $userType = UserType::where('id', $id)->first();

            if (empty($userType)) {
                return response()->json([
                    'message' => 'User type not found'
                ], 422);
            }

            return response()->json([
                'message' => 'Get particular user type',
                'data' => $userType
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function update(UpdateUserTypeRequest $request, $id)
    {
        try {
            $userType = UserType::where('id', $id)->first();

            if (empty($userType)) {
                return response()->json([
                    'message' => 'User type not found'
                ], 422);
            }

            $userType->update($request->validated());

            return response()->json([
                'message' => 'User type updated successfully'
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
