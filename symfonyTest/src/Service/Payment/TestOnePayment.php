<?php

namespace app\Service\Payment;

use app\Service\Payment\PaymentInterface\PaymentInterface;

class TestOnePayment implements PaymentInterface
{

    public function paymentSum(): int
    {
       return 2 + 2;
    }
}