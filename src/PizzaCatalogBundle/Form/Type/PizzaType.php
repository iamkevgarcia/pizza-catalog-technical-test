<?php

namespace PizzaCatalogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints as Constraint;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Genos\RestManagementBundle\Exception\InvalidFormException;
use PizzaCatalogBundle\Entity\Pizza;

class PizzaType extends AbstractType
{

    public function buildForm( FormBuilderInterface $builder, array $options ) {

        $builder->add( 'name', TextType::class, array(
            'required'    => true,
            'constraints' => array(
                new Constraint\NotBlank( array( 'groups' => 'form' ) )
            )
        ) );

        $builder->add( 'sellingPrice', NumberType::class, array(
            'required'    => true,
            'constraints' => array(
                new Constraint\NotBlank( array( 'groups' => 'form' ) )
            )
        ) );

        $builder->add('Ingredients', EntityType::class, array(
            'class'    => 'PizzaCatalogBundle\Entity\Ingredient',
            'choice_label' => 'name',
            'attr' => array('class' => 'keep-order'),
            'required' => true,
            'multiple' => true,
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults( array(
            'csrf_protection'   => false,
            'data_class'        => Pizza::class,
            'validation_groups' => array( 'form' )
        ) );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Pizza';
    }

}
