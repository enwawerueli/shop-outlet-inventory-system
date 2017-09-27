<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use App\Notifications\Notification;

class ActionConfirmation
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
        $action = $request->get('action');
        if (!$action == 'continue') {
            $message = 'You are about to delete data. This CANNOT be undone! Do you wish to continue?';
            $this->notify('warning', $message, 'confirm');
            $continue = $request->url().'?action=continue';
            return back()->with(compact('continue'));
        }
        return $next($request);
    }
}
