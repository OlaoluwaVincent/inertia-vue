<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', 'http://127.0.0.1:8000');
        $response->headers->set('Access-Control-Allow-Methods', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        // dd(print_r($response->headers));
        // dd($request);
        return $response;
    }
}
