<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Predis\Client;


class RedisController extends AbstractController
{
    /**
     * @Route("/redis", name="redis")
     */
    public function index(): Response
    {
        $q = 0;
        $client = new Client([
            'host'=>$_ENV['IP_DOCKER']
        ]);
        $client->setex('AYE',10,'vottak');
        $value = $client->get('AYE');

        return $this->render('redis/index.html.twig', [
            'controller_name' => 'RedisController',
        ]);
    }
}
