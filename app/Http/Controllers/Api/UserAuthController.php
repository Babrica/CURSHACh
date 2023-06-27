<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserAuthRequest;
use Illuminate\Support\Facades\Storage;

class UserAuthController extends Controller
{
    public function registerUser(UserAuthRequest $request)
    {
        $request->validated();
        if(!empty($request->ava))
        {
            $request->ava = Storage::put('/ava', $request->ava);
        }
        else
        {
            $request->ava = 'ava/avatar.jpg';
        }

        $user = new User
        ([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'number' => $request->number,
            'ava' => $request->ava,
        ]);

//        $user = $request->validated();
        $user->save();
        return Response(['message' => 'Registered'], 200);
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails())
        {
            return Response(['message' => $validator->errors()], 401);
        }

        if(Auth::attempt($request->all()))
        {
            $user = Auth::user();
            $success = $user->createToken('MyApp')->plainTextToken;
            return Response(['token' => $success], 200);
        }

        return Response(['message' => 'Error!'], 401);
    }

    public function userDetails()
    {
        if(Auth::check())
        {
            $user = Auth::user();
            return Response(['data' => $user], 200);
        }
        return Response(['data' => 'Ошибка'], 401);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return Response(['data' => 'logout'], 200);
    }
}
