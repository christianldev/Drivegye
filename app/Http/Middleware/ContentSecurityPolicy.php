<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; " .
                "img-src 'self' data: https://drivegye-production.up.railway.app" .
                "style-src 'self' 'unsafe-inline' *.googleapis.com *.bootstrapcdn.com; " .
                "script-src 'self' 'unsafe-inline' *.googleapis.com *.bootstrapcdn.com maps.googleapis.com maps.gstatic.com; " .
                "font-src 'self' *.googleapis.com *.gstatic.com *.bootstrapcdn.com; " .
                "connect-src 'self' maps.googleapis.com maps.gstatic.com https://maps.googleapis.com; " .
                "frame-ancestors 'self';"
        );


        return $response;
    }
}
