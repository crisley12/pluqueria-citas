<?php

namespace App\Controller;

if (!isset($_SESSION)){
    session_start();
}

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Servicios;

class PersonalController extends AbstractController
{
    
    /**
     * @Route("/citasP", name="personalDashboard")
     */
    public function citasP(): Response
    {
        if($_SESSION["user"]->getRol() != "Personal") return $this->redirectToRoute('auth');
        return $this->render('personal/citasP.html.twig');
        
    }

    /**
     * @Route("/serviciosP", name="serviciosP")
     */
    public function serviciosP(): Response
    {
        if($_SESSION["user"]->getRol() != "Personal") return $this->redirectToRoute('auth');

        $servicio = $this->getDoctrine()->getRepository(Servicios::class)->findAll();
        $servicioList = [];

        foreach ($servicio as $key => $servicios) {
            $servicioList[$key]["id"] = $servicios->getId();
            $servicioList[$key]["name"] = $servicios->getServicio();
            $servicioList[$key]["costo"] = $servicios->getCosto();
        }

        return $this->render('personal/serviciosP.html.twig', [
            "servicio" => $servicioList
        ]);
    }
}


