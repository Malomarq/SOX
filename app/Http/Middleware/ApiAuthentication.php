<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuthentication
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
        $pubkey = $request->input('pubkey');
        $privkey = config('app.privkey');

        if(hash('sha256', $pubkey.$privkey) == config('app.token')){
            return $next($request);
        }

        return response()->json(['message' => 'Error authentication'], 403);
    }
}
