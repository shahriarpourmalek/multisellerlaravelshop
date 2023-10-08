<?php

namespace App\Contracts;

interface SmsNotificationContract
{
    public function verifyCode();

    public function userCreated();

    public function orderPaid();

    public function userOrderPaid();

    public function walletAmountDecreased();

    public function walletAmountIncreased();
}
