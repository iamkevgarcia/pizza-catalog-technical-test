<?php

namespace PizzaCatalogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use PizzaCatalogBundle\Entity\Repository\PizzaRepository;
use PizzaCatalogBundle\Form\Type\PizzaType;

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
        $form = $this->createForm(
            PizzaType::class,
            $this->getHandler('pizza')->get($request->get("id",null)), [
                'action' => $this->generateUrl('post_pizza', [
                    'id' => $request->get("id",null)
                ]),
                'method' => 'POST'
            ]
        );

        $form->handleRequest($request);

        return $this->render('PizzaCatalogBundle:Pizza:get_pizza.html.twig', [
            'pizza' => $this->getHandler('pizza')->get($request->get("id",null)),
            'form' => $form->createView()
        ]);
    }

    public function updateAction(Request $request)
    {
        $form = $this->createForm(
            PizzaType::class,
            $this->getHandler('pizza')->get($request->get("id",null)), [
                'action' => $this->generateUrl('post_pizza', [
                    'id' => $request->get("id",null)
                ]),
                'method' => 'POST'
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pizzaData = $form->getData();
            $pizzaObj = $this->getHandler('pizza')->update($pizzaData);
            $this->addFlash(
                'notice',
                'Your new ingredients were saved!'
            );
            return $this->redirectToRoute(
                'get_pizza_by_id',
                array('id' => $pizzaObj->getId())
            );
        }

        return $this->render('PizzaCatalogBundle:Pizza:get_pizza.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    // public function postAction(Request $request)
    // {
    //
    //
    //     $statusCode = Codes::HTTP_CREATED;
    //     $handlerMethod = 'post';
    //     if ($pizza = $this->getHandler('pizza')->get( $request->get("id",null))) {
    //         $handlerMethod = 'put';
    //         $statusCode = Codes::HTTP_NO_CONTENT;
    //     }
    //     $pizza = $this->getHandler('pizza')->$handlerMethod(
    //         $pizza, $request->request->all()
    //     );
    //     $routeOptions = array(
    //         'id' => $pizza->getId()
    //     );
    //     return $this->routeRedirectView('get_pizza_by_id', $routeOptions, $statusCode);
    // }

    // protected function getOr404( $id )  {
    //
    //     if ( !( $course = $this->getHandler( 'enrolment' )->get( $id ) ) ) {
    //         throw new NotFoundHttpException( sprintf( 'The Pizza \'%s\' was not found.', $id ) );
    //     }
    //     return $course;
    // }
}
