<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
            return redirect()->route('client.index')->with('error', 'Bạn không có quyền truy cập web admin. Chuyển hướng sau 3 giây...');
        }

        return $next($request);
    }

}
