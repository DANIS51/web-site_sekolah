<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OperatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Error.', 'Silahkan Logikan Terlebih Dahulu');
        }

        if (Auth::user()->role !== 'Operator') {
            return redirect()->route('dasboard')->withErrors('Error.', 'Anda Bukan Operator');
        }
        return $next($request);
    }
}
