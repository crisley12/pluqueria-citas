<?php

namespace App\Controller;

if (!isset($_SESSION)){
    session_start();
}

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Servicios;
use App\Entity\Usuario;

class CitasController extends AbstractController
{
    /**
     * @Route("/citas", name="citas")
     */
    public function cita(): Response
    {
        return $this->render('citas/cita.html.twig', [
            'controller_name' => 'CitasController',
        ]);
    }

/**
     * @Route("/successCita", name="successCita")
     */
    public function successCita(): Response
    {
        $servicios = $this->getDoctrine()->getRepository(Servicios::class)->findByName($_POST['servicio']);
/*        $personalData = $servicios[0]->getPersonalData();
        $user = $this->getDoctrine()->getRepository(Usuario::class)->find($_SESSION['user']->getID());
        $citas = new Citas();
        $citas->setFecha($user);
        $citas->setHora($_POST["fecha"]);
        $citas->setUser($_POST["hora"]);
        $citas->setUser($_POST["telefono"]);
        $citas->setServicio($servicio);
        $citas->setPersonalData($personalData); 

       $manager = $this->getDoctrine()->getManager();
        $manager->persist($citas);
        $manager->flush();*/

        return $this->render('citas/successCita.html.twig');
    }

}
