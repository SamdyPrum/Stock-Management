<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class UserController extends Controller
{
    /**
     * @Route("user", name="user")
     */
    public function listAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          // Encode the new users password
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // Set their role
            $user->setRole($role);
            // Save
            /**
             * @var $blogPost BlogPost
             */
            $blogPost = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($blogPost);
            $em->flush();

        }

        $em = $this->getDoctrine()->getManager();
        $blogPosts = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('default/UserManage.html.twig', [
            'blog_posts' => $blogPosts,
            'form' => $form->createView()
        ]);
    }
    /**
     * @param Request  $request
     * @param BlogPost $blogPost
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/edit/{blogPost}", name="edit")
     */
    public function editAction(Request $request, User $blogPost)
    {
        $form = $this->createForm(UserType::class, $blogPost);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new users password
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($blogPost, $blogPost->getPlainPassword());
            $blogPost->setPassword($password);

            // Set their role
            $blogPost->setRole('Administrator');
            // Save
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // for now
            return $this->redirectToRoute('user', [
                'blogPost' => $blogPost->getId(),
            ]);

        }

        return $this->render('default/EditUser.html.twig', [
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
    public function deleteAction(Request $request, User $blogPost)
    {
        if ($blogPost === null) {
            return $this->redirectToRoute('user');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($blogPost);
        $em->flush();

        return $this->redirectToRoute('user');
    }
}
