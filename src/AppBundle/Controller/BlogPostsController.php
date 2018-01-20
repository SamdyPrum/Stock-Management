<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlogPost;
use AppBundle\Form\BlogPostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class BlogPostsController extends Controller
{
    /**
     * @Route("list", name="list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $blogPosts = $em->getRepository('AppBundle:BlogPost')->findAll();

        return $this->render('default/list.html.twig', [
            'blog_posts' => $blogPosts,
        ]);
    }

    /**
     * @param Request $request
     * @Route("/create", name="create")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(BlogPostType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var $blogPost BlogPost
             */
            $blogPost = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($blogPost);
            $em->flush();

            // for now
            return $this->redirectToRoute('edit', [
                'blogPost' => $blogPost->getId(),
            ]);

        }

        return $this->render('default/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request  $request
     * @param BlogPost $blogPost
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/ddedit/{blogPost}", name="edit")
     */
    public function editAction(Request $request, BlogPost $blogPost)
    {
        $form = $this->createForm(BlogPostType::class, $blogPost);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // for now
            return $this->redirectToRoute('edit', [
                'blogPost' => $blogPost->getId(),
            ]);

        }

        return $this->render('default/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request  $request
     * @param BlogPost $blogPost
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/delesste/{blogPost}", name="delete")
     */
    public function deleteAction(Request $request, BlogPost $blogPost)
    {
        if ($blogPost === null) {
            return $this->redirectToRoute('list');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($blogPost);
        $em->flush();

        return $this->redirectToRoute('list');
    }
}