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
use App\Entity\ClienteData;
use App\Entity\PersonalData;
use App\Entity\Citas;



class PersonalController extends AbstractController
{
    
    /**
     * @Route("/citasP", name="personalDashboard")
     */
    public function citasP(): Response
    {
        if($_SESSION["user"]->getRol() != "Personal") return $this->redirectToRoute('auth');
        
        $user = $this->getDoctrine()->getRepository(Usuario::class)->find($_SESSION["user"]->getId());
        $personal = $user->getPersonalData();
        $citas = $this->getDoctrine()->getRepository(Citas::class)->findBy([
            "PersonalData" => $personal
        ]);
        
        $citasList = [];
        foreach ($citas as $key => $cita) {
            $citasList[$key]["id"] = $cita->getId();
            $citasList[$key]["clienteData"] = $cita->getClienteData()->getUsuario()->getName();
            $citasList[$key]["PersonalData"] = $cita->getPersonalData()->getUsuario()->getName();
            $citasList[$key]["hora"] = $cita->getHora()->format("H:i");
            $citasList[$key]["fecha"] = $cita->getFecha()->format("d-m-Y");
            $citasList[$key]["servicio"] = $cita->getServicio()->getServicio();
            $citasList[$key]["costo"] = $cita->getServicio()->getCosto();

        }
        return $this->render('personal/citasP.html.twig', [ "citas" => $citasList ]);
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

