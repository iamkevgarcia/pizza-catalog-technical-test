<?php

namespace PizzaCatalogBundle\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;

class BaseHandler
{
    protected $formFactory;
    protected $repository;

    public function __construct(EntityManager $entityManager, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->repository = $entityManager->getRepository($entityClass);
        $this->formFactory = $formFactory;
    }
}
