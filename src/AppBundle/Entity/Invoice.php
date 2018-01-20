<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Product_name;
     /**
     * @ORM\Column(type="string", length=100)
     */
    private $Quantity;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    private $Price;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Discount;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Amount;
    public function eraseCredentials()
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setProduct_name($product_name)
    {
        $this->name = $product_name;
    }

    public function getProduct_name()
    {
        return $this->product_name;
    }

    public function getUsername()
    {
        return $this->quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    
    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
    
    public function getDiscount()
    {
        return $this->discount;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }
    
    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
  
    public function getSalt()
    {
        return null;
    }
   
}