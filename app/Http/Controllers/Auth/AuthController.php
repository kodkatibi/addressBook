<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return $this->login($request);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return $this->response(['error' => 'Unauthorized'], self::STATUS_CODE_401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $expiration = time() + 60 * 60;

        $payload = [
            'sub' => Auth::id(),
            'iat' => time(),
            'exp' => $expiration
        ];

        return $this->response([
            'token' => JWT::encode($payload, config('auth.jwt_secret'), 'HS256'),
            'expires_in' => $expiration
        ]);
    }
}
