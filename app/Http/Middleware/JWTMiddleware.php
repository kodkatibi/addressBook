<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

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

        try {
            $decoded = JWT::decode($jwt, config('auth.jwt_secret'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $request->user = $decoded;
        return $next($request);
    }
}
