<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
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
        // Kiểm tra xem session có jwt_token không (hoặc tùy theo logic bạn cần)
        if (!session()->has('jwt_token') || !session()->has('admin')) {
            return redirect()->route('admin.loginForm');
        }

        return $next($request);
    }
}
