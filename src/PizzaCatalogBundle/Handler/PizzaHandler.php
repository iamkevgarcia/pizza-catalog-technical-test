<?php

namespace PizzaCatalogBundle\Handler;

use PizzaCatalogBundle\Entity\Pizza;

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
}
