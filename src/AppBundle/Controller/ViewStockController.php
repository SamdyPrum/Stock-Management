<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class ViewStockController extends Controller
{
    /**
   * @Route("/viewstock", name="viewstock")
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

        return $this->render('default/ViewStock.html.twig', [
            'blog_posts' => $blogPosts,
            'form' => $form->createView()
        ]);
    }
}