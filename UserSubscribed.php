<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\System\User;
use App\Models\System\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class UserSubscribed
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
        if (Auth::guard($guard ?? \App\Models\System\User::GUARD)->check()) {
            $user = $request->user();

            if ($user->hasRole(Role::USER)) {
                if (!$user->subscribed('default')) {
                    return redirect()->route('user.setup.account.subscription.signup');
                }

                // Check if user hasn't paid subscription.
                if ($user->setup_completed == User::SETUP_COMPLETED && $user->subscribed('default') !== true) {
                    // redirect to billing
                }

                // Check if hasn't choose a subscription
                if ($user->setup_completed == User::SETUP_INCOMPLETE) {
                    return redirect('user.setup.account');
                }
            }
        }

        return $next($request);
    }
}
