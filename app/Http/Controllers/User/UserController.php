<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\CreateUserRequest;


class UserController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('users.view')) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::orderBy('created_at', 'DESC')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->can('users.create')) {
            abort(403, 'Unauthorized action.');
        }

        $regions = Region::orderBy('name', 'ASC')->get();
        $roles = Role::orderBy('name', 'ASC')->get();

        return view('users.create', compact('regions', 'roles'));
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);
            $user->roles()->sync($request->validated('role'));

            return redirect()->route('users.index')->with('status', 'User account created successfully.');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (!auth()->user()->can('users.update')) {
            abort(403, 'Unauthorized action.');
        }

        $regions = Region::orderBy('name', 'ASC')->get();
        $roles = Role::orderBy('name', 'ASC')->get();
        $userRole = $user->roles()->pluck('id')->toArray();

        return view('users.edit', compact('user', 'regions', 'roles', 'userRole'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();

            if (empty($request->validated('password'))) {
                $data['password'] = $user->password;
            } else {
                $data['password'] = Hash::make($data['password']);
            }

            $user->update($data);
            $user->roles()->sync($request->validated('role'));

            return redirect()->route('users.index')->with('status', 'User account updated successfully.');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
