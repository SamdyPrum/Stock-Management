<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use AppBundle\Form\CustomerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class CustomerController extends Controller
{
    /**
   * @Route("/customermanagement", name="customermanagement")
   */

      public function listAction(Request $request)
    {
        $form = $this->createForm(CustomerType::class);
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
        $blogPosts = $em->getRepository('AppBundle:Customer')->findAll();

        return $this->render('default/Customer.html.twig', [
            'blog_posts' => $blogPosts,
            'form' => $form->createView()
        ]);
    }
    /**
     * @param Request  $request
     * @param BlogPost $blogPost
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/editcustomer/{blogPost}", name="editcustomer")
     */
    public function editAction(Request $request, Customer $blogPost)
    {
        $form = $this->createForm(CustomerType::class, $blogPost);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // for now
            return $this->redirectToRoute('customermanagement', [
                'blogPost' => $blogPost->getId(),
            ]);

        }

        return $this->render('default/EditCustomer.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request  $request
     * @param BlogPost $blogPost
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/delete/{blogPost}", name="delete")
     */
    public function deleteAction(Request $request, Customer $blogPost)
    {
        if ($blogPost === null) {
            return $this->redirectToRoute('customermanagement');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($blogPost);
        $em->flush();

        return $this->redirectToRoute('customermanagement');
    }
}