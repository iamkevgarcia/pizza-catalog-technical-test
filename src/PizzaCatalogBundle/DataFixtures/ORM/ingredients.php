<?php

namespace PizzaCatalogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use \Doctrine\Common\Persistence\ObjectManager;
use PizzaCatalogBundle\Entity\Ingredient;

class ingredients_ extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
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

        $ingredients = require_once __DIR__ .  DIRECTORY_SEPARATOR . '../Data/ingredients.php';

        foreach ($ingredients as $ingredient) {
            $ingredientObj = new Ingredient();
            foreach ($ingredient as $key => $value) {
                $set = 'set';
                $set .= ucfirst($key);
                $ingredientObj->$set($value);
            }
            $em->persist($ingredientObj);
            $this->addReference( 'ingredients_'.$ingredient[ 'name' ], $ingredientObj );
        }

        $em->flush();
        $em->clear();
    }

    public function getOrder()
    {
        return 15;
    }
}
