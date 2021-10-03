<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if(!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'msg' => 'Token not provided.'
            ], 401);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_KEY'), ['HS256']);
        } catch (\Exception $th) {
            return response()->json([
                'error' => 'An error while decoding token.'
            ], 400);
        }catch (ExpiredException $th) {
            return response()->json([
                'error' => 'Token expired.'
            ], 400);
        }
        

        $request->auth = $credentials->data;
        
        return $next($request);
    }
}
