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
     * @Route("/{page}", name="homepage", requirements={"page"="\d+"})
     */

    public function indexAction(EntityManagerInterface $entityManager, $page = 1)
    {
        $page = intval($page);
        $firstResult = ($page - 1) * 5;

        $noteRepository = $entityManager->getRepository(Note::class);
        $notes = $noteRepository->selectNotes($firstResult);
        $countNotes = $noteRepository->countNotes();

        $maxPages = intval(ceil($countNotes[1] / 5));

        return $this->render("default/homepage.html.twig", array(
            'notes' => $notes,
            'page' => $page,
            'maxPages' => $maxPages,
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