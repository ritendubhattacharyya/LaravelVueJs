<?php

namespace App\Http\Controllers;

use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App;

class NotificationController extends Controller
{
    public function store() {
        $cart = App\Cart::where('user_id', auth()->user()->id)->get();
        if($cart->count() !== 0) {
            Notification::send(auth()->user(), new OrderNotification());
            App\Cart::where('user_id', auth()->user()->id)->delete();
            return redirect('/home');
        } else {
            return back()->with('cart_error', 'No products');
        }
    }

    public function index() {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $readNotifications = auth()->user()->readNotifications;
        $unreadNotifications->markAsRead();
        return view('/notifications', [
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications
        ]);
    }
}
