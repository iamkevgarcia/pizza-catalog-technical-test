<?php

namespace PizzaCatalogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use \Doctrine\Common\Persistence\ObjectManager;
use PizzaCatalogBundle\Entity\Ingredient;
use PizzaCatalogBundle\Entity\Pizza;

class courses_ extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{

    private $container;
    private $_em;

    /**
     * Sets the container.
     *
     * @param ContainerInterface $container The container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $em)
    {
        $timezone = 'Europe/Madrid';
        date_default_timezone_set( $timezone );
        $this->_em=$em;
        $em = $this->container->get('doctrine')->getEntityManager('default');
        $pizzas = require_once __DIR__ .  DIRECTORY_SEPARATOR . '../Data/pizzas.php';

        foreach ($pizzas as $pizza) {
            $pizzaObj = new Pizza();
            foreach ($pizza as $key => $value) {
                if ($key === 'ingredients') {
                    foreach ($value as $ingredient) {
                        $pizzaObj->addIngredient(
                            $em->getRepository('PizzaCatalogBundle:Ingredient')->findOneByName($ingredient)
                        );
                    }
                    $pizzaObj->updateSellingPrice();
                    continue;
                }
                $pizzaObj->setName( $value );
            }
            $em->persist($pizzaObj);
            $this->addReference( 'pizzas_'.$pizza[ 'name' ], $pizzaObj );
        }

        $em->flush();
        $em->clear();
    }

    public function getOrder()
    {
        return 16;
    }
}
