<?php

namespace PizzaCatalogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use PizzaCatalogBundle\Entity\Repository\PizzaRepository;

class PizzaController extends BaseController
{
    public function getAction(Request $request)
    {
        // \Doctrine\Common\Util\Debug::dump($this->getHandler('pizza')->getAll());
        return $this->render('PizzaCatalogBundle:Pizza:pizzas_list.html.twig', [
            'pizzas' => $this->getHandler('pizza')->getAll()
        ]);
    }

    public function getByIdAction(Request $request)
    {
        return $this->render('PizzaCatalogBundle:Pizza:get_pizza.html.twig', [
            'pizza' => $this->getHandler('pizza')->get($request->get("id",null))
        ]);
    }

    public function getEnrolmentsByStudentAction( Request $request ) {
        $studentId = $request->get( 'pizza_id', null );
        return $this->getHandler( 'enrolment' )->getEnrolmentsByStudent( $pizzaId );
    }

    // protected function getOr404( $id )  {
    //
    //     if ( !( $course = $this->getHandler( 'enrolment' )->get( $id ) ) ) {
    //         throw new NotFoundHttpException( sprintf( 'The Pizza \'%s\' was not found.', $id ) );
    //     }
    //     return $course;
    // }
}
