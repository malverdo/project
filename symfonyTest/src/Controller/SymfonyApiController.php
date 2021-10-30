<?php

namespace App\Controller;

use App\Form\ApiType;
use App\Form\PostType;
use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SymfonyApiController extends AbstractController
{

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    /**
     * @Route("/symfony/api", name="symfony_api")
     */
    public function index(Request $request): Response
    {

        $number = 0;
        $form = $this->createForm(ApiType::class,null, [
            'method' => 'GET',
        ]);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $response = $this->client->request(
                'GET',
                'http://symfonyapi.local/test?one=' . $data['one'] . '&two=' . $data['two']
            );
            $statusCode = $response->getStatusCode();
            // $statusCode = 200
            $contentType = $response->getHeaders()['content-type'][0];
            // $contentType = 'application/json'
            $content = $response->getContent();
            // $content = '{"id":521583, "name":"symfony-docs", ...}'
            $content = $response->toArray();
            // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

            foreach ($content as $conten) {
                $number += $conten;
            }
        }


        return $this->render('symfony_api/index.html.twig', [
            'namber' => $number,
            'form' => $form->createView(),
        ]);
    }
}
