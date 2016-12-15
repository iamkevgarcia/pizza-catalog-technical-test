<?php

namespace PizzaCatalogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render(
            'PizzaCatalogBundle::base.html.twig'
        );
    }
}
