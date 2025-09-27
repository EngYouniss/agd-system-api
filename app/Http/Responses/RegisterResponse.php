<?php

namespace App\Http\Responses;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;


class RegisterResponse implements RegisterResponseContract
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
        ],201);
    }

}
