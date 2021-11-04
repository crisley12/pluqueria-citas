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
     * @Route("/dashboardPersonal", name="dashboardPersonal")
     */
    public function dashboardPersonall(): Response
    {
        if($_SESSION["user"]->getRol() != "Personal") return $this->redirectToRoute('auth');
        return $this->render('personal/dashboardPersonal.html.twig', [
            'controller_name' => 'PersonalController',
        ]);
    }

    /**
     * @Route("/citas", name="citas")
     */
    public function citas(): Response
    {
        if($_SESSION["user"]->getRol() != "Personal") return $this->redirectToRoute('auth');
        return $this->render('personal/citas.html.twig');
        
    }

    /**
     * @Route("/servicios", name="servicios")
     */
    public function servicios(): Response
    {
        if($_SESSION["user"]->getRol() != "Personal") return $this->redirectToRoute('auth');
        return $this->render('personal/servicios.html.twig');
        
    }
}


