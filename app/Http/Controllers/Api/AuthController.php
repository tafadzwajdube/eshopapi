<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
public function userx(){
    return response()->json(['user'=>auth()->user()], 200);
}



    public function register(Request $request)
    {
        $validatedData= $request->validate([
            'name'=>'required|max:100',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed'

        ]);

        $validatedData['password']=bcrypt($request->password);

        $user=User::create($validatedData);

        $accessToken= $user->createToken('authToken')->accessToken;

        return response(['user'=>$user, 'access_token'=>$accessToken]);

    }

    public function login(Request $request)
    {

$loginData= $request->validate([
            'email'=>'email|required',
            'password'=>'required'

        ]);

        if(!auth()->attempt($loginData)){
            return response()->json(['message'=>'invalid credentials'], 401);
        }

        $accessToken=auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['user'=>auth()->user(), 'access_token'=> $accessToken], 200);

    }
}
