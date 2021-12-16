<?php

namespace app\Service\Payment;

use app\Service\Payment\PaymentInterface\PaymentInterface;

class TestTwoPayment implements PaymentInterface
{

    public function paymentSum(): int
    {
        return 2 * 8;
    }
}