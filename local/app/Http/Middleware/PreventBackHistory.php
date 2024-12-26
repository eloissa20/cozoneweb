<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle($request, Closure $next)
    // {
    //     $response = $next($request);
    //     return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
    //         ->header('Pragma','no-cache')
    //         ->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
    // }
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Only modify headers if the response is not a BinaryFileResponse
        if (!$response instanceof BinaryFileResponse) {
            $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');
        }

        return $response;
    }
}