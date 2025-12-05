<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index() {
        return view('pages.general.notifications.index');
    }

    /**
     * mark all unread notification read
     */
    public function markAllRead() {
        foreach(Auth::user()->unReadNotifications as $item){
            $item->markRead();
        }
    }
}
