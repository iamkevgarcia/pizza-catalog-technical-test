<?php

namespace PizzaCatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="PizzaCatalogBundle\Entity\Repository\IngredientRepository")
 * @ORM\Table(name="ingredient")
 * @ORM\Entity
 */
class Ingredient
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="numeric",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $price;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Ingredient
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param float sellPrice
     *
     * @return Ingredient
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}
