<?php
namespace App\Application\Command;


use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserManager  extends AbstractController
{
    public function recordEvent(string $username, string $data)
    {


        $post = new Post();
        $post->setTitle($username);
        $post->setSlug($username);
        $post->setBody($username);
        $post->setCreatedAt(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();
    }
}