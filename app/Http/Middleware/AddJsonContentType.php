<?php

namespace App\Http\Middleware;

use Closure;

class AddJsonContentType 
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Add the Content-Type header if it's not already set
        if (!$response->headers->has('Content-Type')) {
            $response->header('Content-Type', 'application/json');
        }

        return $response;
    }
}
