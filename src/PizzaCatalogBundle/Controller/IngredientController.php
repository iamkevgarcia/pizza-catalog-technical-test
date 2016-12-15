<?php

namespace PizzaCatalogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class IngredientController extends BaseController
{
    public function getAction(Request $request)
    {
        // \Doctrine\Common\Util\Debug::dump($this->getHandler('pizza')->getAll());
        return $this->render('PizzaCatalogBundle:Ingredient:ingredients_list.html.twig', [
            'ingredients' => $this->getHandler('ingredient')->getAll()
        ]);
    }

    public function getByIdAction(Request $request)
    {
        return $this->render('PizzaCatalogBundle:Ingredient:get_ingredient.html.twig', [
            'ingredient' => $this->getHandler('ingredient')->get($request->get("id",null))
        ]);
    }
}
