<?php

declare(strict_types=1);

namespace App\Http\Middleware;
use Illuminate\Http\Request;

use Closure;

/**
 * XssSanitization Middleware
 *
 * @copyright 2020 MdRepTime, LLC
 * @package App\Http\Middleware
 */
class XssSanitization
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
        $input = $request->all();
        array_walk_recursive($input, function(&$input) {
            if(filled($input) && is_string($input)) {
                $input = strip_tags($input);
            }
        });
        $request->merge($input);
        return $next($request);

    }
}


