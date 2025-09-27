<?php

namespace App\Http\Responses;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;


class LoginResponse implements LoginResponseContract
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function toResponse($request)
    {

        $user=$request->user();
        $user->tokens()->delete();

        $token=$user->createToken('api_token')->plainTextToken;

        return response()->json([
            'user'=>$user,
            'token'=>$token,
            'type'=>'bearer',
        ],200);
    }

}
