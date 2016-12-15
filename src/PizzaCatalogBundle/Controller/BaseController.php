<?php

namespace PizzaCatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    protected function getHandler( $name )
    {
        return $this->container->get( sprintf( 'pizza_catalog_bundle.%s.handler', $name ) );
    }

    /**
    * @throws NotFoundHttpException
    */
    protected function getOr404($id, $handler)
    {
        if (!( $object = $this->getHandler( $handler )->get( $id ))) {
            throw new NotFoundHttpException( sprintf( 'The \'%s\' \'%s\' was not found.', $handler, $id ) );
        }
        return $object;
    }
}
