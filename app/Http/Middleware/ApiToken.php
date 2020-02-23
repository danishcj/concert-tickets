<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (User::where([['id', '=', 1], ['api_token', '=', $request->api_token ]])->exists()) {
            return $next($request);
        } else {
            return response()->json([
                'status_code' => '401',
                'message' => 'Unauthorized'
              ], 401);
        }
    }
}
