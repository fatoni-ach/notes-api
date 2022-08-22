<?php

namespace App\Http\Middleware;

use App\Helper\Respond;
use App\Models\User;
use Closure;

class KeyMiddleware
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
        // Pre-Middleware Action
        $key = $request->query('key') ?? null;

        $user = ($key) ? User::where('secret_key', $key)->first()
                        : null;
        if(! $user) {
            return Respond::failed(401, 'unauthorized', 'You are unauthorized');
        }

        $request->user = $user;

        $response = $next($request);

        // Post-Middleware Action

        return $response;
    }
}
