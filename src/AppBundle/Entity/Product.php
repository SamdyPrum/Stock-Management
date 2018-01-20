<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;
     /**
     * @ORM\Column(type="string", length=100)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal",type="string", length=10 , nullable=true)
     */
    private $price;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $approved;
    /**
     * @ORM\ManyToMany(targetEntity="Picture", cascade={"persist"})
     * @ORM\JoinTable(name="Product_picture",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="picture_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $pictures;

    public function eraseCredentials()
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUsername()
    {
        return $this->description;
    }

    public function getDecription()
    {
        return $this->description;
    }

    public function setDecription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
    
    public function getApproved()
    {
        return $this->approved;
    }

    public function setApproved($approved)
    {
        $this->approved = $approved;
    }
     public function addPicture(Picture $picture)
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
        }
        return $this;
    }
    public function getPictures()
    {
        return $this->pictures;
    }
    public function setPictures(Collection $pictures)
    {
        $this->pictures = $pictures;
        return $this;
    }
  
    public function getSalt()
    {
        return null;
    }
   
}