<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestController extends AbstractController
{

    /**
     * @Route("/test", name="test")
     */
    public function index(Request $request): Response
    {
        $one = $request->query->get('one');
        $two = $request->query->get('two');
        $response = new JsonResponse();
        $ra = $one + $two;
        $response->setData([$ra]);

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}