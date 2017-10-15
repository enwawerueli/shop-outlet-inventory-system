<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use App\Messages\Message;

class CheckPermission
{
    use Message;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $action)
    {
        if (!$request->user()->hasPermission($action)) {
        // User does not have required permission. Block request and send notification.
            $message = 'Action DENIED for this user. You do not have the required permission!';
            $this->notify('restricted', $message);
            return back();
        }
        // Otherwise, user has permission. Allow request.
        return $next($request);
    }
}
