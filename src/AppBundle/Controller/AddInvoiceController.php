<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Invoice;
use AppBundle\Form\InvoiceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddInvoiceController extends Controller
{
    /**
   * @Route("/addcustomer", name="addcustomer")
   */
    public function showAction(Request $request)
    {
      
        // 1) build the form
        $invoice = new Invoice();
        $form = $this->createForm(CustomerType::class, $invoice);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('invoicemanagement');
        }
         

        return $this->render('default/InvoiceManagement.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}