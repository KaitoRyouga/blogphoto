<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class checkAdminLogin
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
        // nếu user đã đăng nhập
        if (Auth::check())
        {
            return $next($request);

        } else
            return redirect('admin/login');

    }
}