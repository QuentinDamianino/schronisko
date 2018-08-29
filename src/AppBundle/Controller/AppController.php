<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dog;
use AppBundle\Entity\Shelter;
use AppBundle\Form\addDogType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

class AppController extends Controller
{
    /**
     * @Route("/status", name="status")
     */

    public function statusAction(EntityManagerInterface $entityManager)
    {
        $dogRepository = $entityManager->getRepository(Dog::class);
        $dogs = $dogRepository->findAll();
        $countDogs = $dogRepository->countDogs();

        $shelter = $entityManager->getRepository(Shelter::class)->find(1);
        if ($shelter->getOccupiedRooms() != $countDogs[1])
        {
            $shelter->setOccupiedRooms($countDogs[1]);
            $entityManager->flush();
        }

        $shelterRepository = $entityManager->getRepository(Shelter::class);
        $rooms = $shelterRepository->findAll();

        if(!$dogs){
            throw $this->createNotFoundException(
                "Nie znaleziono żadnego psa"
            );
        }

        return $this->render('default/status.html.twig', array(
            'dogs' => $dogs,
            'rooms' => $rooms,
        ));
    }

    /**
     * @Route("/addDog", name="addDog")
     */

    public function addAction(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader)
    {
        $shelter = $entityManager->getRepository(Shelter::class)->find(1);
        if ($shelter->getOccupiedRooms() >= $shelter->getRooms())
        {
            $this->addFlash(
                'warning',
                'Schronisko jest przepełnione. Nie możesz dodać więcej zwierząt'
            );

            return $this->redirectToRoute('status');
        }

        else{
            $dog = new Dog();
            $form = $this->createForm(addDogType::class, $dog);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                if ($dog->getImage() != null)
                {
                    $file = $dog->getImage();
                    $fileName = $fileUploader->upload($file);
                    $dog->setImage($fileName);
                }

                $dog = $form->getData();
                $entityManager->persist($dog);
                $entityManager->flush();

                return $this->redirectToRoute('status');
            }
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

    /**
     * @Route("/edit/{id}", name="edit")
     */

    public function editAction($id, Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader)
    {
        $dog = $entityManager->getRepository(Dog::class)->find($id);
        $currentImage = $dog->getImage();
        if ($dog->getImage() != null)
        {
            $dog->setImage(
                new File($this->getParameter('dogs_photo_directory').'/'.$dog->getImage())
            );
        }

        $form = $this->createForm(addDogType::class, $dog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            if ($dog->getImage() == null)
            {
                $dog->setImage($currentImage);
            }
            else
            {
                $file = $dog->getImage();
                $fileName = $fileUploader->upload($file);
                $dog->setImage($fileName);
            }

            $entityManager->flush();

            return $this->redirectToRoute('status');
        }

        return $this->render('default/editDog.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @return string
     */

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
