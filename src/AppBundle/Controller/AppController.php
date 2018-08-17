<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
}
