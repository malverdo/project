<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\user;

class TestUserMigrationsController extends  AbstractController
{
    /**
     * @Route ("/q", name="users")
     */
    public function index()
    {

        $doctrine = $this->getDoctrine();
        $users = $doctrine->getRepository(user::class)->findAll();

        return $this->render('user/user.html.twig', [
            'title' => 'hello word',
            'users' => $users
        ]);
    }
}