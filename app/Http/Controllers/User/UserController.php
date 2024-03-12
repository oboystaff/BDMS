<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        try {
            $data = User::with(['region'])->get();

            return response()->json([
                'message' => 'Get all users',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $data = User::create($request->validated());

            return response()->json([
                'message' => 'User created successfully',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $user = User::with(['region'])
                ->where('id', $id)
                ->orWhere('phone', $id)
                ->orWhere('email', $id)
                ->first();

            if (empty($user)) {
                return response()->json([
                    'message' => 'User not found'
                ], 422);
            }

            return response()->json([
                'message' => 'Get particular user',
                'data' => $user
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = User::with(['region'])
                ->where('id', $id)
                ->orWhere('phone', $id)
                ->orWhere('email', $id)
                ->first();

            if (empty($user)) {
                return response()->json([
                    'message' => 'User not found'
                ], 422);
            }

            $user->update($request->validated());

            return response()->json([
                'message' => 'User updated successfully'
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
