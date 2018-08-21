<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 19.08.2018
 * Time: 01:32
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class addDogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label' => 'Imię:'))
            ->add('race', TextType::class, array('label' => 'Rasa:'))
            ->add('gender', ChoiceType::class, array('choices' => array(
                'pies' => 'Pies',
                'suka' => 'Suka',
            ), 'label' => 'Płeć'))
            ->add('age', NumberType::class, array('label' => 'Wiek:'))
            ->add('submit', SubmitType::class, array(
                'label' => 'Dodaj',
                'attr' => [
                    'class' => 'clear'
                ]
            ))
            ->getForm();
    }
}