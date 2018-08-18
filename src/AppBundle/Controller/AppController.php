<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dog;
use AppBundle\Form\addDogType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */

    public function indexAction()
    {
        return $this->render("default/homepage.html.twig");
    }

    /**
     * @Route("/add", name="add")
     */

    public function addAction(Request $request, EntityManagerInterface $entityManager)
    {
        $name = $request->query->get('name');
        $race = $request->query->get('race');
        $gender = $request->query->get('gender');
        $age = $request->query->get('age');

        $dog = new Dog();

        $dog->setName($name);
        $dog->setRace($race);
        $dog->setGender($gender);
        $dog->setAge($age);

        $date = new \DateTime('now');

        $dog->setLastFeed($date);
        $dog->setLastWalk($date);

        $form = $this->createForm(addDogType::class, $dog);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $dog = $form->getData();
            $entityManager->persist($dog);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/addDog.html.twig', array(
            'form' => $form->createView(),
        ));
    }


}
