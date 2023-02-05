<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $jwt = $request->header('Authorization');
        if (!$jwt) {
            return response()->json(['error' => 'Authorization header not found'], 401);
        }
        $jwt = Str::after($jwt, 'Bearer ');
        try {
            $decoded = JWT::decode($jwt, new Key(config('jwt.jwt_secret'), config('jwt.encrypt_algo')));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Invalid token'], 401);
        }
        $user = User::find($decoded->sub);
        Auth::login($user);
        return $next($request);
    }
}
