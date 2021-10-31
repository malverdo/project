<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class VueController extends AbstractController
{
    /**
     * @Route("/vue", name="vue")
     */
    public function index(Request $request): Response
    {
        $vue = json_decode($request->getContent());

        if (isset($vue->two) && isset($vue->one) ) {
            $result = $vue->two + $vue->one ;
        }
        return new JsonResponse(
            [

                'title' => 'hello world symfony',
                'result' =>  $result ?? null
            ]
        );
    }
}
