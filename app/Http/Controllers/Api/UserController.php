<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function store(UserStoreRequest $request)
    {
        $created_user = User::create($request->validated());
        return $created_user;
    }

    public function show(string $id)
    {
        return new UserResource(User::findOrFail($id));
    }

    public function update(UserStoreRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->except(['id']));
        $user->save();
        return response()->json($user);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

}
