<?php

namespace App\Http\Middleware\Backend;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ExchangeRateDefaultFilterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->input() == null) {
            $url = $request->fullUrlWithQuery(
                [
                    "date_between" => Carbon::now()->startOfDay()->toDateTimeString()." - ".Carbon::now()->endOfDay()->toDateTimeString(),
                ]
            );

            return redirect($url);
        }

        return $next($request);
    }
}
