<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\System\Site;
use Closure;

/**
 * Site Mode Check Middleware
 *
 * @copyright 2020 MDRepTime, LLC
 * @package   App\Http\Middleware
 */
class SiteMode
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
        if (setting('site_status', config('app.domain'), true) == Site::INACTIVE) {
            abort(503, 'Sorry, we\'re down for scheduled maintenance');
        }

        return $next($request);
    }
}
