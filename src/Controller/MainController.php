<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', methods: ['GET'])]
    public function userFormPage(): Response
    {
        // return new Response('<strong>USER FORM:</strong> please fill up the following form');
        return $this->render('main/userFormPage.html.twig');
    }
}
