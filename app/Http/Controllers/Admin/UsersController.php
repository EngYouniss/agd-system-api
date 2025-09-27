<?php

namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use App\Models\User;
// use Illuminate\Validation\ValidationException;

// class UsersController extends Controller
// {
//     public function login(Request $request)
//     {
//         $credentials = $request->validate([
//             'email'    => ['required', 'email'],
//             'password' => ['required'],
//         ]);

//         $user = User::where('email', $credentials['email'])->first();

//         if (! $user || ! Hash::check($credentials['password'], $user->password)) {
//             return response()->json([
//                 'status'  => 'error',
//                 'message' => 'Invalid credentials',
//             ], 200);
//         }

//         $token = $user->createToken('auth_token')->plainTextToken;

//         return response()->json([
//             'status'  => 'success',
//             'message' => 'Login successful',
//             'user'    => [
//                 'id'    => $user->id,
//                 'name'  => $user->name,
//                 'email' => $user->email,
//             ],
//             'token'   => $token,
//         ], 200);
//     }
// }
