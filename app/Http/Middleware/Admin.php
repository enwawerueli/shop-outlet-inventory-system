<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use App\Notifications\Notification;

class Admin
{
    use Notification;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->is_admin()) {
        // User is not admin. Block request and send notification.
            $message = 'Permission DENIED for this user. Administrative privilege is required for this action.';
            $this->notify('restricted', $message);
            return back();
        }
        // User is admin. Allow request.
        return $next($request);
    }
}
