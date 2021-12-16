<?php

namespace App\Controller;

use app\Service\Payment\PaymentInterface\PaymentInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use app\Service\Payment\TestOnePayment;

class TestOneInterfaceController extends AbstractController
{
    /**
     * @var PaymentInterface
     */
    public PaymentInterface $PaymentInterface;

    /**
     * @var TestOnePayment
     */
    public TestOnePayment $TestOnePayment;

    public function __construct(PaymentInterface $PaymentTwoInterface, TestOnePayment $TestOnePayment)
    {
        $this->PaymentInterface = $PaymentTwoInterface;
    }

    /**
     * @Route("/test/one/interface", name="test_one_interface")
     */
    public function index(): Response
    {
//        dd($this->PaymentInterface->paymentSum());

        return $this->render('test_one_interface/index.html.twig', [
            'controller_name' => 'TestOneInterfaceController',
        ]);
    }
}
