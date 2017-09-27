<?php
namespace App\Notifications;

use Illuminate\Support\Facades\Session;

trait Notification
{

    /**
     * Flush a notification to the session
     *
     * @param string $status
     * @param string $message
     * @param string $dialog
     *
     * @return void
     */
    public function notify($status, $message, $dialog='alert')
    {
        $notification = compact('status', 'message', 'dialog');
        Session::flash('notification', $notification);
        return true;
    }

    /**
     * Flush success notification to the session
     *
     * @param string $message
     *
     * @return void
     */
    public function notifySuccess($message)
    {
        return $this->notify('success', $message);
    }

    /**
     * Flush error notification to the session
     *
     * @param string $message
     *
     * @return void
     */
    public function notifyError($message)
    {
        return $this->notify('failed', $message);
    }
}
