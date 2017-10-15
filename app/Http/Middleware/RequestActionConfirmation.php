<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use App\Messages\Message;

class RequestActionConfirmation
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
        $confirm = $request->get('confirm');
        if (!$confirm == 'continue') {
            switch ($action) {
                case 'delete':
                    $message = 'You are about to delete data. This CANNOT be undone! Do you wish to continue?';
                    break;
                default:
                    $message = 'Please confirm this action.';
                    break;
            }
            $this->notify('warning', $message, 'confirm');
            $continue = $request->url().'?confirm=continue';
            return back()->with(compact('continue'));
        }
        return $next($request);
    }
}
