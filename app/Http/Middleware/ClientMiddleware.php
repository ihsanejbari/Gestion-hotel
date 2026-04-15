<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientMiddleware {
    public function handle(Request $request, Closure $next) {
        if (!auth()->check() || auth()->user()->role !== 'client') {
            if (auth()->check()) {
                return redirect()->route('dashboard');
            }
            return redirect()->route('login');
        }
        return $next($request);
    }
}