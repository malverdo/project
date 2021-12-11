<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\User;
use App\Form\SearchType;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Repository\PostRepository;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\InputBag;
use Knp\Component\Pager\PaginatorInterface;
use App\EventListener\UserAgentSubscriber;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\CommentType;
use DateTimeImmutable;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class PostController extends AbstractController
{

    /** @var PostRepository $postRepository */
    private $postRepository;

    /** @var CommentRepository $CommentRepository */
    private $CommentRepository;

    public function __construct(PostRepository $postRepository, CommentRepository $CommentRepository)
    {
        $this->postRepository = $postRepository;
        $this->CommentRepository = $CommentRepository;
    }

    /**
     * @Route("/post", name="post")
     */
    public function index(PaginatorInterface $paginator, Request $request,EventDispatcherInterface $dispatcher): ?Response
    {
//        $event = new PostNumberEvent();
//        $listener = new PostListener();
//        $dispatcher->addListener(
//                PostNumberEvent::NAME,
//                array($listener, 'onPostNumberAction'));
//        $dispatcher->dispatch($event, PostNumberEvent::NAME);



        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));


        $log->warning('предупреждение ошибка', ['123','124123',['1'=>'2']]);
        $log->error('фатальная ошибка');

        $posts = $this->postRepository->allPostCountComment();

        $pagination = $paginator->paginate(
            $posts, /* query NOT result */
            $request->query->getInt('page',1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('post/index.html.twig', [
            'posts' => $pagination
        ]);
    }


    /**
     * @Route("/post/new", name="new_blog_post")
     */
    public function addPost(Request $request, Slugify $slugify)
    {

        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $post->setSlug($slugify->slugify($post->getTitle()));
            $post->setCreatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post');
        }
        return $this->render('post/new.html.twig', [
            'form' => $form->createView(),
            'posts' => ''
        ]);
    }

    /**
     * @Route("/post/search", name="blog_search")
     */
    public function search(Request $request)
    {


        if ($request->isXmlHttpRequest()) {
            $query = $request->request->get('search');
            $posts = $this->postRepository->searchByQuery($query);

            return new JsonResponse($posts);
        }

        $post = new Post();
        $form = $this->createForm(SearchType::class, $post, [
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid() ) {
            $query = $request->query->get('search');
            $posts = $this->postRepository->searchByQuery($query['title']);

            return $this->render('post/blog/query_post.html.twig', [
                'form' => $form->createView(),
                'posts' => $posts
            ]);
        } else {
            $posts = $this->postRepository->findAll();
            return $this->render('post/blog/query_post.html.twig', [
                'form' => $form->createView(),
                'posts' => $posts
            ]);
        }


//        $query = $request->query->get('searchInput');
//        if (is_string($query)) {
//            $posts = $this->postRepository->searchByQuery($query);
//            if (empty($posts)) {
//                return $this->render('post/blog/query_post.html.twig', [
//                    'posts' => [],
//                    'empty' => 'Несуществует'
//                ]);
//            }
//            return $this->render('post/blog/query_post.html.twig', [
//                'posts' => $posts
//            ]);
//        }
//        $posts = $this->postRepository->searchByQuery('');
//        return $this->render('post/blog/query_post.html.twig', [
//            'posts' => $posts
//        ]);

    }


    /**
     * @Route("/post/{slug}", name="blog_show")
     */
    public function post($slug, Request $request, Post $postNew)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment, [
            'method' => 'POST',
        ]);
        $form->handleRequest($request);
        $post =  $this->postRepository->searchSlug($slug);

        if ($form->isSubmitted() && $form->isValid() ) {

            $comment->setUserid($this->getUser());
            $comment->setCreatedAt(new DateTimeImmutable());
            $postNew->addComment($comment);


            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('blog_show', ['slug' => $postNew->getSlug()]);
        }

        // удаление всех коментариев пользователя 23
        $this->CommentRepository->deliteCommentUser(23);


        $comments =  $this->CommentRepository->findCommentUser($postNew->getId());
        return $this->render('post/show.html.twig', [
            'form' => $form->createView(),
            'posts' => $post,
            'comments' => $comments
        ]);


    }

    /**
     * @Route("/post/{slug}/edit", name="blog_post_edit")
     */
    public function edit($slug, Post $post, Request $request, Slugify $slugify)
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setSlug($slugify->slugify($post->getTitle()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('blog_show', [
                'slug' => $post->getSlug()
            ]);
        }
        $post = $this->postRepository->findBy(array('slug' => $slug));
        return $this->render('post/new.html.twig', [
            'form' => $form->createView(),
            'posts' => $post
        ]);
    }

    /**
     * @Route("/post/{slug}/delete", name="blog_post_delete")
     */
    public function delete($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $this->postRepository->findOneBy(array('slug' => $slug));

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('post');
    }


}
