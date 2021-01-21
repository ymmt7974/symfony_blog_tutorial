<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;    # Postエンティティ
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/blog")
 */
class BlogController extends Controller
{
    /**
     * @Route("/", name="blog_index")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findAll();  // Postを全件取得

        return $this->render('blog/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/{id}", name="blog_show")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->find($id);   //指定されたidのPostを取得

        if (!$post) {
            throw $this->createNotFoundException('The post does not exist');
        }

        return $this->render('blog/show.html.twig', ['post' => $post]);
    }
}