<?php

namespace App\Controller;

if (!isset($_SESSION)){
    session_start();
}

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonalController extends AbstractController
{
    /**
     * @Route("/login-process", name="personal")
     */
    public function index(): Response
    {
        return $this->render('personal/index.html.twig', [
            'controller_name' => 'PersonalController',
        ]);
    }
}
