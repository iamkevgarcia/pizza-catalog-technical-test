<?php

namespace PizzaCatalogBundle\Handler;

use PizzaCatalogBundle\Entity\Pizza;
use PizzaCatalogBundle\Form\Type\PizzaType;

class PizzaHandler extends BaseHandler
{
    public function get($id)
    {
        return $this->repository->findOneById($id);
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function update(Pizza $pizza)
    {
        $this->em->persist($pizza);
        $this->em->flush($pizza);
        return $pizza;
    }
}
