<?php

namespace App\Policies\sellers;

use App\Models\Order;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellersOrderPolicy
{
    use HandlesAuthorization;
    public function viewAny(Seller $user)
    {
        return true;
    }

    public function view( Seller $user, Order $order)
    {
        return $user->can('sellers.orders.view');
    }

    public function create(Seller $user)
    {
        return $user->can('sellers.orders.create');
    }

    public function update(Seller $user, Order $order)
    {
        return $user->can('sellers.orders.update');
    }

    public function delete(Seller $user, Order $order)
    {
        return $user->can('sellers.orders.delete');
    }
}
