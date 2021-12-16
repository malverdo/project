<?php

namespace App\Controller\Refactoring\LongMethod;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LongMethodController extends AbstractController
{

    public function __construct()
    {
    }

    function printOwing() {
        $b = 4 + 4;
        // Print details.
        $this->printDetails(20);
    }


    function printDetails($outstanding) {
        print("name:  " . 10);
        print("amount " . 20);
    }
}