<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(UserRequest $request)
    {
        if(!Auth::attempt($request->only('email','password')))
        {
            return responseJson(0,'The Email Or Password Is Wrong');
        }
        $token = auth()->user()->createToken('API Token')->accessToken;
        return responseJson(1,'success',['user'=>auth()->user(),'token'=>$token]);
    }
}
