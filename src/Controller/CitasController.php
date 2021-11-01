<?php

namespace App\Controller;

if (!isset($_SESSION)){
    session_start();
}

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Servicios;
use App\Entity\Citas;
use App\Entity\PersonalData;
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
        $servicio = $this->getDoctrine()->getRepository(Servicios::class)->find(explode(' ',$_POST['servicio'])[0]);
        $personal = $this->getDoctrine()->getRepository(PersonalData::class)->find(explode(' ',$_POST['servicio'])[1]);
        $cliente = $this->getDoctrine()->getRepository(Usuario::class)->find($_SESSION['user']->getId())->getClienteData();

        $citas = new Citas();
        $citas->setClienteData($cliente);
        $citas->setServicio($servicio);
        $citas->setPersonalData($personal); 
        $citas->setFecha(new \Datetime($_POST["fecha"]));
        $citas->setHora(new \Datetime($_POST["hora"]));

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($citas);
        $manager->flush();

        return $this->render('citas/successCita.html.twig');
    }

}

