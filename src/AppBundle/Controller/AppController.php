<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dog;
use AppBundle\Form\addDogType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route("/status", name="status")
     */

    public function statusAction(EntityManagerInterface $entityManager)
    {
        $dogs = $entityManager->getRepository(Dog::class)->findAll();

        if(!$dogs){
            throw $this->createNotFoundException(
                "Nie znaleziono żadnrgo psa"
            );
        }

        return $this->render('default/status.html.twig', array(
            'dogs' => $dogs,
        ));
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

    /**
     * @Route("/delete/{id}", name="delete")
     */

    public function deleteAction($id, EntityManagerInterface $entityManager)
    {
        $dog = $entityManager->getRepository(Dog::class)->find($id);

        $entityManager->remove($dog);
        $entityManager->flush();

        return $this->redirectToRoute("status");
    }
}
