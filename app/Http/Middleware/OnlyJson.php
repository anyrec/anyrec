<?php

namespace App\Http\Middleware;

use Closure;

class OnlyJson
{
    /**
     * The URIs that should be excluded from JSON verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $this->shouldPassThrough($request)) {
            if (! $request->wantsJson()) {
                return response()->json([
                   'error' => "Client must accept 'application/json'",
                ], 406);
            }
            if (! $request->isJson() && in_array($request->getMethod(), ['POST', 'PATCH', 'PUT'])) {
                return response()->json([
                    'error' => "Content type must be 'application/json'",
                ], 415);
            }
        }

        return $next($request);
    }

    /**
     * Determine if the request has a URI that should pass through JSON verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function shouldPassThrough($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
