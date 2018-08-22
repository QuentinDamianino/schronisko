<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 22.08.2018
 * Time: 03:20
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Note;
use AppBundle\Form\addNoteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function indexAction(EntityManagerInterface $entityManager)
    {
        $noteRepository = $entityManager->getRepository(Note::class);
        $notes = $noteRepository->findAll();

        return $this->render("default/homepage.html.twig", array(
            'notes' => $notes
        ));
    }

    /**
     * @Route("/addNote", name="addNote")
     */

    public function addNoteAction(Request $request, EntityManagerInterface $entityManager)
    {
        $title = $request->query->get('title');
        $content = $request->query->get('content');
        $date = new \DateTime("now");
        $creator = $this->get('security.token_storage')->getToken()->getUsername();

        $note = new Note();

        $note->setTitle($title);
        $note->setContent($content);
        $note->setDate($date);
        $note->setCreator($creator);

        $form = $this->createForm(addNoteType::class, $note);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $note = $form->getData();
            $entityManager->persist($note);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/addNote.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}