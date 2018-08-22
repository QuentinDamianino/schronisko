<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 22.08.2018
 * Time: 02:41
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class addNoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array('label' => 'Tytuł'))
            ->add('content', TextareaType::class, array(
                'label' => 'Treść',
                'attr' => [
                    'rows' => 10
                ]
            ))
            ->add('submit', SubmitType::class, array('label' => 'Dodaj'))
            ->getForm();
    }
}