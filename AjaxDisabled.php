<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;

/**
 * AjaxDisabled Middleware
 *
 * @copyright 2020 MDRepTime, LLC
 * @package   App\Http\Middleware
 */
class AjaxDisabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->ajax()) {
            return response()->json(
                [
                'status'    => 'error',
                'message'   => 'AJAX not allowed'
                ]
            );
        }

        return $next($request);
    }
}
