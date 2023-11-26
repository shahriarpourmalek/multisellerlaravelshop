<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(object $user)
    {
        if ($user instanceof  Seller)
        {
            return $user->can('sellers.orders.index');

        }
        return $user->can('orders.index');
    }

    public function view(object $user, Order $order)
    {
        if ($user instanceof  Seller)
        {
            return $user->can('sellers.orders.view');

        }
        return $user->can('orders.view');
    }

    public function create(object $user)
    {
        if ($user instanceof  Seller)
        {
            return $user->can('sellers.orders.create');

        }
        return $user->can('orders.create');
    }

    public function update(object $user, Order $order)
    {
        if ($user instanceof  Seller)
        {
            return $user->can('sellers.orders.update');

        }
        return $user->can('orders.update');
    }

    public function delete(object $user, Order $order)
    {
        if ($user instanceof  Seller)
        {
            return $user->can('sellers.orders.delete');

        }
        return $user->can('orders.delete');
    }
}
