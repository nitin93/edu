<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

public function register(Request $request)
{
    $request->validate([
        'username' => 'required|string|unique:edu_users',
        'email' => 'required|email|unique:edu_users',
        'password' => 'required|string|min:6',
        'role' => 'required|string',
    ]);

    $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role        
    ]);

    return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
}

}
