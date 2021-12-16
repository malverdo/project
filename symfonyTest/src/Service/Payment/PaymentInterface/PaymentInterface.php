<?php

namespace app\Service\Payment\PaymentInterface;

interface PaymentInterface
{
    public function paymentSum(): int;
}