<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(object $user)
    {
        if($user instanceof  Seller)
        {
            return $user->can('sellers.products.index');
        }
        return $user->can('products.index');
    }

    public function create(object $user)
    {
        if($user instanceof  Seller)
        {
            return $user->can('sellers.products.create');
        }
        return $user->can('products.create');
    }

    public function update(object $user, Product $product)
    {
        if($user instanceof  Seller)
        {
            return $user->can('sellers.products.update');
        }
        return $user->can('products.update');
    }

    public function delete(object $user, Product $product)
    {
        if($user instanceof  Seller)
        {
            return $user->can('sellers.products.delete');
        }
        return $user->can('products.delete');
    }
}
