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
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class addDogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
            ->add('race', TextType::class)
            ->add('gender', ChoiceType::class, array('choices' => array(
                'bitch' => 'bitch',
                'dog' => 'dog',
            )))
            ->add('age', NumberType::class)
            ->add('lastFeed', DateTimeType::class, array('widget' => 'single_text'))
            ->add('lastWalk', DateTimeType::class, array('widget' => 'single_text'))
            ->add('submit', SubmitType::class, array('label' => 'Dodaj'))
            ->getForm();
    }
}