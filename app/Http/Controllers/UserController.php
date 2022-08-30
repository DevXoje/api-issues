<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Error;

class UserController extends ApiController
{
    public function index()
    {
        if (!$users = User::all()) {
            return $this->errorResponse('No users found', 404);
        }
        return $this->successResponse("Users fetched", $users);
    }

    public function store(StoreUserRequest $request)
    {
        //Puede que falle
        if (!$validData = $request->validated()) {
            //errors() puede que no exista, buscar sustituto
            return $this->errorResponse('Validation error.', $request->errors(), 400);
        }

        try {
            $user = User::create($validData);
            return $this->successResponse("User Created", $user, 201);
        } catch (Error $e) {
            return $this->errorResponse('Error creating product.', $e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        if (!$user = User::find($id)) {
            return $this->errorResponse('User not found', 404);
        }
        return $this->successResponse("User Fetched", $user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        //Puede que falle
        if (!$validData = $request->validated()) {
            //errors() puede que no exista, buscar sustituto
            return $this->errorResponse('Validation error.', $request->errors());
        }

        if (!$user = User::find($id)) {
            return $this->errorResponse('User not found', 404);
        }
        $old_user = $user->toArray();
        $user->update($validData);
        return $this->successResponse("User Updated", [
            'old' => $old_user,
            'updated' => $user,
        ]);
    }

    public function destroy($id)
    {
        if (!$user = User::find($id)) {
            return $this->errorResponse('User not found', 404);
        }
        $user->delete();
        return $this->successResponse("User Deleted", $user);
    }
}
