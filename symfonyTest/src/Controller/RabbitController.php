<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitController extends AbstractController
{
    /**
     * @Route("/rabbit", name="rabbit")
     */
    public function index(): Response
    {

        $connection = new AMQPStreamConnection($_ENV['IP_DOCKER'], 5672, 'guest', 'guest');

        $channel = $connection->channel();
        $channel->queue_declare('hello3', false, false, false, false);

        $msg = new AMQPMessage(mt_rand());
        $channel->basic_publish($msg, '', 'hello3');
        $channel->close();
        $connection->close();


//        $connection = new AMQPStreamConnection($_ENV['IP_DOCKER'], 5672, 'guest', 'guest');
//
//        $channel = $connection->channel();
//        $result = $channel->basic_get('hello3');
//        $callback = function ($msg) {
//            print_r($msg->body);
//        };
//        $channel->basic_consume( 'hello3',
//             '',
//            false,
//            false,
//             false,
//            false,
//            $callback);

//        print_r($result->body);
//        print_r($result->getRoutingKey());

//        $channel->close();
//        $connection->close();

        return $this->render('rabbit/index.html.twig', [
            'controller_name' => 'RabbitController',
        ]);
    }
}
