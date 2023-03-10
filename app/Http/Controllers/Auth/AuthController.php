<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

        if (!Auth::attempt($credentials)) {
            return $this->response(['error' => 'Unauthorized'], self::STATUS_CODE_401);
        }

        return $this->respondWithToken();
    }

    protected function respondWithToken()
    {

        $expiration = time() + 60 * 60;

        $payload = [
            'sub' => Auth::id(),
            'iat' => time(),
            'exp' => $expiration
        ];

        return $this->response([
            'token' => JWT::encode($payload, config('jwt.jwt_secret'), self::ALLOWED_ALGOS),
            'expires_in' => $expiration
        ]);
    }
}
