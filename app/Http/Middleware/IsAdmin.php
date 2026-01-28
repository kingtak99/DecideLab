<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $adminEmails = [
            'hasantak99@gmail.com',
            'admin99@decidelab.com'
        ];

        if (auth()->check() && in_array(auth()->user()->email, $adminEmails)) {
            return $next($request);
        }

        abort(403, 'Unauthorized access - Admin only');
    }
}
