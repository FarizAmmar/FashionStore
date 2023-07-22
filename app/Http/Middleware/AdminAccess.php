<?php
// app/Http/Middleware/AdminAccess.php

namespace App\Http\Middleware;

use Closure;

class AdminAccess
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->access == 'guest') {
            return redirect('/store');
        }

        return $next($request);
    }
}
