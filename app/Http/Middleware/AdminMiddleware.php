<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware {
    public function handle(Request $request, Closure $next) {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            if (auth()->check()) {
                return redirect()->route('client.dashboard');
            }
            return redirect()->route('login');
        }
        return $next($request);
    }
}