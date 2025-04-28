<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PUtilisateur;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|unique:p_utilisateur,login',
            'username' => 'required|string',
            'psw' => 'required|string|min:6',
            'nomPrenom' => 'required|string',
            'tel' => 'required|string',
            'mail' => 'required|string|email|unique:p_utilisateur,mail',
            'soldeCongeInitial' => 'required|integer',
            'role' => 'required|string'
            
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
            
            $user = PUtilisateur::create([
            'login' => $request->login,
            'username' => $request->username,
            'psw' => Hash::make(trim($request->psw)),
            'nomPrenom' => $request->nomPrenom,
            'tel' => $request->tel,
            'mail' => $request->mail,
            'soldeCongeInitial' => $request->soldeCongeInitial,
            'role' => $request->role
        ]);
        $token = $user->createToken('AuthToken')->accessToken;

        return response()->json(['user' => $user, 'access_token' => $token], 201);
    }



    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'psw' => 'required',
        ]);

        $user = PUtilisateur::where('login', $request->login)->first();
        if (!$user || !Hash::check(trim($request->psw), $user->psw)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('AuthToken')->accessToken;

        return response()->json(['token' => $token, 'user' => $user], 200);
    }
    public function logout(Request $request)
    {

        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}