<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Models\System\User;
use App\Models\System\Role;
use Closure;

/**
 * Check User Status Middleware
 *
 * @copyright 2020 MDRepTime, LLC
 * @package   App\Http\Middleware
 */
class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->guard($guard)->check() === true) {
            if ($guard == User::GUARD && $request->user()->status == User::INACTIVE) {
                auth()->guard($guard)->logout();
                return redirect()->to(site_url());
            }
        }

        return $next($request);
    }
}
