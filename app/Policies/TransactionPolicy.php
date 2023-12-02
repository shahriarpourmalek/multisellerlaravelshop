<?php

namespace App\Policies;

use App\Models\Seller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function viewAny(object $user)
    {
        if ($user instanceof  Seller){
            return $user->can('sellers.payments.transactions.index');

        }

        return $user->can('payments.transactions.index');
    }

    public function view(object $user, Transaction $transaction)
    {
        if ($user instanceof  Seller){
            return $user->can('sellers.payments.transactions.view');

        }
        return $user->can('payments.transactions.view');
    }

    public function delete(object $user, Transaction $transaction)
    {
        if ($user instanceof  Seller){
            return $user->can('sellers.payments.transactions.delete');

        }
        return $user->can('payments.transactions.delete');
    }
}
