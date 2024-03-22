<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Registration\CreateBookshopRequest;
use App\Http\Requests\Registration\CreateSchoolRequest;
use App\Http\Requests\Registration\CreateWholesaleRequest;
use App\Http\Requests\Registration\UpdateBookshopRequest;
use App\Http\Requests\Registration\UpdateSchoolRequest;
use App\Http\Requests\Registration\UpdateWholesaleRequest;
use App\Models\Registration;
use App\Models\RegistrationType;
use App\Models\User;
use App\Models\UserType;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index()
    {
        try {
            $data = Registration::with(['region', 'zone', 'territory', 'registrationType', 'agent'])
                ->get();

            return response()->json([
                'message' => 'Get all client registrations',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function byType($id)
    {
        try {
            $data = Registration::with(['region', 'zone', 'territory', 'registrationType', 'agent'])
                ->where('reg_type_id', $id)
                ->get();

            if (count($data) == 0) {
                return response()->json([
                    'message' => 'Client registration not found'
                ], 422);
            }

            return response()->json([
                'message' => 'Get all client registrations',
                'data' => $data
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function storeSchool(CreateSchoolRequest $request)
    {
        try {
            $data = $request->validated();
            $data['agent_id'] = $request->user()->id;

            $registrationType = RegistrationType::query()
                ->where('name', 'like', '%school%')
                ->latest('created_at')
                ->first();

            $userType = UserType::query()
                ->where('name', 'like', '%user%')
                ->latest('created_at')
                ->first();

            $data['reg_type_id'] = $registrationType->id ?? '';

            $reg = Registration::create($data);

            if (!empty($reg)) {
                $userData = [
                    'name' => $reg->name,
                    'email' => $reg->email ?? '',
                    'phone' => $reg->phone,
                    'region_id' => $reg->region_id,
                    'password' => env('DEFAULT_PASSWORD'),
                    'user_type_id' => $userType->id ?? ''
                ];

                User::create($userData);
            }

            return response()->json([
                'message' => 'School registration created successfully',
                'data' => $reg
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function storeBookshop(CreateBookshopRequest $request)
    {
        try {
            $data = $request->validated();
            $data['agent_id'] = $request->user()->id;

            $registrationType = RegistrationType::query()
                ->where('name', 'like', '%bookshop%')
                ->latest('created_at')
                ->first();

            $userType = UserType::query()
                ->where('name', 'like', '%user%')
                ->latest('created_at')
                ->first();

            $data['reg_type_id'] = $registrationType->id ?? '';

            $reg = Registration::create($data);

            if (!empty($reg)) {
                $userData = [
                    'name' => $reg->name,
                    'email' => $reg->email ?? '',
                    'phone' => $reg->phone,
                    'region_id' => $reg->region_id,
                    'password' => env('DEFAULT_PASSWORD'),
                    'user_type_id' => $userType->id ?? ''
                ];

                User::create($userData);
            }

            return response()->json([
                'message' => 'Bookshop registration created successfully',
                'data' => $reg
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function storeWholesale(CreateWholesaleRequest $request)
    {
        try {
            $data = $request->validated();
            $data['agent_id'] = $request->user()->id;

            $registrationType = RegistrationType::query()
                ->where('name', 'like', '%wholesale%')
                ->latest('created_at')
                ->first();

            $userType = UserType::query()
                ->where('name', 'like', '%user%')
                ->latest('created_at')
                ->first();

            $data['reg_type_id'] = $registrationType->id ?? '';

            $reg = Registration::create($data);

            if (!empty($reg)) {
                $userData = [
                    'name' => $reg->name,
                    'email' => $reg->email ?? '',
                    'phone' => $reg->phone,
                    'region_id' => $reg->region_id,
                    'password' => env('DEFAULT_PASSWORD'),
                    'user_type_id' => $userType->id ?? ''
                ];

                User::create($userData);
            }

            return response()->json([
                'message' => 'Bookshop registration created successfully',
                'data' => $reg
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $registration = Registration::with(['region', 'zone', 'territory', 'registrationType', 'agent'])
                ->where('id', $id)
                ->orWhere('reg_id', $id)
                ->first();

            if (empty($registration)) {
                return response()->json([
                    'message' => 'Client registration not found'
                ], 422);
            }

            return response()->json([
                'message' => 'Get paerticular client registration',
                'data' => $registration
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function updateSchool(UpdateSchoolRequest $request, $id)
    {
        try {
            $registration = Registration::with(['region', 'zone', 'territory', 'registrationType'])
                ->where('id', $id)
                ->orWhere('reg_id', $id)
                ->first();

            if (empty($registration)) {
                return response()->json([
                    'message' => 'School registration not found'
                ], 422);
            }

            $user = User::where('phone', $registration->phone)->first();

            $registration->update($request->validated());

            if (!empty($user)) {
                $user->update([
                    'name' => $request->validated('name'),
                    'phone' => $request->validated('phone'),
                    'email' => $request->validated('email'),
                    'region_id' => $request->validated('region_id')
                ]);
            }

            return response()->json([
                'message' => 'School registration updated successfully'
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function updateBookshop(UpdateBookshopRequest $request, $id)
    {
        try {
            $registration = Registration::with(['region', 'zone', 'territory', 'registrationType'])
                ->where('id', $id)
                ->orWhere('reg_id', $id)
                ->first();

            if (empty($registration)) {
                return response()->json([
                    'message' => 'Bookshop registration not found'
                ], 422);
            }

            $user = User::where('phone', $registration->phone)->first();

            $registration->update($request->validated());

            if (!empty($user)) {
                $user->update([
                    'name' => $request->validated('name'),
                    'phone' => $request->validated('phone'),
                    'email' => $request->validated('email'),
                    'region_id' => $request->validated('region_id')
                ]);
            }

            return response()->json([
                'message' => 'Bookshop registration updated successfully'
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function updateWholesale(UpdateWholesaleRequest $request, $id)
    {
        try {
            $registration = Registration::with(['region', 'zone', 'territory', 'registrationType'])
                ->where('id', $id)
                ->orWhere('reg_id', $id)
                ->first();

            if (empty($registration)) {
                return response()->json([
                    'message' => 'Wholesale registration not found'
                ], 422);
            }

            $user = User::where('phone', $registration->phone)->first();

            $registration->update($request->validated());

            if (!empty($user)) {
                $user->update([
                    'name' => $request->validated('name'),
                    'phone' => $request->validated('phone'),
                    'email' => $request->validated('email'),
                    'region_id' => $request->validated('region_id')
                ]);
            }

            return response()->json([
                'message' => 'Wholesale registration updated successfully'
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
