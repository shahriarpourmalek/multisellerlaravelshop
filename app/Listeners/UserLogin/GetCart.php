<?php

namespace App\Listeners\UserLogin;

use App\Models\Cart;
use App\Models\Seller;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class GetCart
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if (!$event->user instanceof Seller) {
            store_user_cart($event->user);
        }
    }
}
