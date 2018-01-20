<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AddProductController extends Controller
{
    /**
   * @Route("/addproduct", name="addproduct")
   */
    public function showAction(Request $request)
    {
      
        // 1) build the form
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
             
            return $this->redirectToRoute('stockmanagement');
            return new Response('Saved new product with id '.$product->getId());
        }
         

        return $this->render('default/AddProduct.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}