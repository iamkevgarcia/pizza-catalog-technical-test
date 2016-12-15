<?php

namespace PizzaCatalogBundle\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;

class BaseHandler
{
    protected $formFactory;
    protected $repository;
    protected $entityManager;

    public function __construct(EntityManager $entityManager, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->em = $entityManager;
        $this->repository = $entityManager->getRepository($entityClass);
        $this->formFactory = $formFactory;
    }
}
