<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InvoiceController extends Controller
{
    /**
   * @Route("/invoicemanagement", name="invoicemanagement")
   */
    public function showAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/InvoiceManagement.html.twig');
    }
}