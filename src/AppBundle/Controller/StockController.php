<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class StockController extends Controller
{
    /**
     * @Route("stockmanagement", name="stockmanagement")
     */
    public function listAction(Request $request)
    {
        $form = $this->createForm(ProductType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var $blogPost BlogPost
             */
            $blogPost = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($blogPost);
            $em->flush();

        }

        $em = $this->getDoctrine()->getManager();
        $blogPosts = $em->getRepository('AppBundle:Product')->findAll();

        return $this->render('default/AddProduct.html.twig', [
            'blog_posts' => $blogPosts,
            'form' => $form->createView()
        ]);
    }
    /**
     * @param Request  $request
     * @param BlogPost $blogPost
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/editstock/{blogPost}", name="editstock")
     */
    public function editAction(Request $request, Product $blogPost)
    {
        $form = $this->createForm(ProductType::class, $blogPost);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // for now
            return $this->redirectToRoute('stockmanagement', [
                'blogPost' => $blogPost->getId(),
            ]);

        }

        return $this->render('default/EditProduct.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request  $request
     * @param BlogPost $blogPost
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/deletestock/{blogPost}", name="deletestock")
     */
    public function deleteAction(Request $request, Product $blogPost)
    {
        if ($blogPost === null) {
            return $this->redirectToRoute('stockmanagement');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($blogPost);
        $em->flush();

        return $this->redirectToRoute('stockmanagement');
    }
}