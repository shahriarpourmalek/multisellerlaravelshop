<?php

namespace App\Policies\sellers;

use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellersProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(Seller $user)
    {
        return $user->can('seller_products.index');
    }

    public function create(Seller $user)
    {
        return $user->can('seller_products.create');
    }

    public function update(Seller $user, Product $product)
    {
        return $user->can('seller_products.update');
    }

    public function delete(Seller $user, Product $product)
    {
        return $user->can('seller_products.delete');
    }
}
