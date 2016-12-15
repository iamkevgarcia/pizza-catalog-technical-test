<?php

namespace PizzaCatalogBundle\Handler;

class IngredientHandler extends BaseHandler
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
