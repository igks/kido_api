<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use IlluminateContractsAuthGuard;
use Response;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!isset($_SERVER['HTTP_APIKEY'])) {
            return Response::json(array('error' => 'Please provide authentication key!'));
        }

        if ($_SERVER['HTTP_APIKEY'] != 'ezfvopbzvdamzfueomizobonkvqkabds') {

            return Response::json(array('error' => 'Authentication key is invalid!'));
        }

        return $next($request);
    }
}
