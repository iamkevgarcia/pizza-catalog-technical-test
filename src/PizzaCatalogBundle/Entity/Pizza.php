<?php

namespace PizzaCatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="PizzaCatalogBundle\Entity\Repository\PizzaRepository")
 * @ORM\Table(name="pizza")
 * @ORM\Entity
 */
class Pizza
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
     * Many Pizzas have many Ingredients.
     * @ORM\ManyToMany(targetEntity="Ingredient")
     * @ORM\JoinTable(name="pizza_ingredient",
     *      joinColumns={@ORM\JoinColumn(name="pizza_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")}
     *      )
     */
    private $ingredients;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="numeric",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $sellingPrice;

    public function __construct() {
        $this->ingredients = new ArrayCollection();
    }

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
     * @return Pizza
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
     * Set selling price
     *
     * @param float sellingPrice
     *
     * @return Pizza
     */
    public function setSellingPrice($sellingPrice)
    {
        $this->sellingPrice = $sellingPrice;
        return $this;
    }

    /**
     * Get selling price
     *
     * @return float
     */
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    /**
     * Add ingredient
     *
     * @param \PizzaCatalogBundle\Entity\Ingredient $ingredient
     *
     * @return Course
     */
    public function addIngredient(Ingredient $ingredient)
    {
        $this->ingredients[] = $ingredient;

        return $this;
    }

    /**
     * Remove ingredient
     *
     * @param \PizzaCatalogBundle\Entity\Ingredient $ingredient
     */
    public function removeIngredient(Ingredient $ingredient)
    {
        $this->ingredients->removeElement( $ingredient );
    }

    /**
     * Get ingredients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function updateSellingPrice()
    {
        $sellingPrice = 0;
        foreach ($this->getIngredients() as $ingredient) {
            $sellingPrice += $ingredient->getPrice();
        }
        $sellingPrice += $sellingPrice * 0.50;
        return $this->setSellingPrice($sellingPrice);
    }
}
