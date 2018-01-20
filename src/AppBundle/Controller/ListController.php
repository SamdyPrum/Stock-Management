<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller
{
    /**
   * @Route("/", name="homeG")
   */
    public function showAction(Request $request)
    {
        return $this->render('auth/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}