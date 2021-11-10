<?php

namespace App\Controller;

if (!isset($_SESSION)){
    session_start();
}

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use App\Entity\ClienteData;
use App\Entity\PersonalData;
use App\Entity\Servicios;
use App\Entity\Citas;

class AdminController extends AbstractController
{
    /**
     * @Route("/listausers", name="adminDashboard")
     */
    public function listausers(): Response
    {
        if($_SESSION["user"]->getRol() != "Admin") return $this->redirectToRoute('auth');


        $users = $this->getDoctrine()->getRepository(Usuario::class)->findAll();
        $userList = [];
        foreach ($users as $key => $user) {
            $userList[$key]["id"] = $user->getId();
            $userList[$key]["email"] = $user->getEmail();
            $userList[$key]["password"] = $user->getPassword();
            $userList[$key]["rol"] = $user->getRol();
            $userList[$key]["name"] = $user->getName();
            $userList[$key]["telefono"] = $user->getTelefono();
        }

        return $this->render('admin/listausers.html.twig', [
            "users" => $userList
        ]);
        
    }
    
/**
     * @Route("/listausersError", name="listausersError")
     */
    public function listausersError(): Response
    {
    return $this->render('admin/listausersError.html.twig');

    }

    /**
     * @Route("/createusers", name="createUsers", methods="POST")
     */
    public function createUsers(): Response
    {
        
        $error = null;
        if($_POST['password'] != $_POST['cpassword']) $error = "Contraseña invalida, vuelve a intertarlo";
        else if(strlen($_POST['password']) < 4 || strlen($_POST['password']) > 8) $error = "Contraseña invalida, ingrese undigito mayor a 4 y menor que 8";
        else if($_POST['telefono'] < 4140000000) $error = "ingrese un número de telefono valido";
           
        if($error == null){
            $user = new Usuario();
            $user->setName($_POST["username"]);
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST["password"]);
            $user->setTelefono($_POST["telefono"]);
            $user->setRol($_POST["type"]);

            switch ($user->getRol()) {
                case 'Cliente': {
                    $clientData = new ClienteData();
                    $user->setClienteData($clientData);
                }   break;
                case 'Personal': {
                    $personalData = new PersonalData();
                    $user->setPersonalData($personalData);
                } break;
                default: break;
            }

            try {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('adminDashboard');
            } catch (\Throwable $th) {
                return $this->render('admin/listausersError.html.twig',  [ "error" => "Este correo ya esxiste, ingrese otro" ]);
               
                
            }
        } else {
             return $this->render('admin/listausersError.html.twig', [ "error" => $error ]);
        }
    }
    
    /**
     * @Route("/updateuser/{id}", name="updateUsers", methods="POST")
     */
    public function updateUsers($id): Response
    {
        $error = null;
        if($_POST['password'] != $_POST['cpassword']) $error = "Contraseña invalida, vuelve a intertarlo";
        else if(strlen($_POST['password']) < 4 || strlen($_POST['password']) > 8) $error = "Contraseña invalida, ingrese undigito mayor a 4 y menor a 8";
        else if($_POST['telefono'] < 4140000000) $error = "ingrese un número de telefono valido";
           
        if($error == null){
            $user = $this->getDoctrine()->getRepository(Usuario::class)->find($id);
            $user->setName($_POST["username"]);
            $user->setPassword($_POST["password"]);
            $user->setTelefono($_POST["telefono"]);

            try {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('adminDashboard');
            } catch (\Throwable $th) {
                return $this->render('admin/listausersError.html.twig',  [ "error" => "Este correo ya esxiste, ingrese otro" ]);
            }
        } else {
            return $this->render('admin/listausersError.html.twig',  [ "error" => $error]);
        }
    }

    /**
     * @Route("/delete/{id}", name="deleteuser", methods="POST")
     */
    public function delteUser($id): Response
    {
        $user = $this->getDoctrine()->getRepository(Usuario::class)->find($id);
    
        $delete = $this->getDoctrine()->getManager();
        $delete->remove($user);
        $delete->flush();

        return $this->redirectToRoute('adminDashboard');
    }


    /**
     * @Route("/serviciosAdmin", name="serviciosAdmin")
     */
    public function serviciosAdmin(): Response
    {
        if($_SESSION["user"]->getRol() != "Admin") return $this->redirectToRoute('auth');

        $servicio = $this->getDoctrine()->getRepository(Servicios::class)->findAll();
        $servicePersonal = [];

        foreach ($servicio as $key => $servicios) {
            $servicioList[$key]["id"] = $servicios->getId();
            $servicioList[$key]["name"] = $servicios->getServicio();
            $servicioList[$key]["costo"] = $servicios->getCosto();
        }

        return $this->render('admin/serviciosAdmin.html.twig', [
            "servicio" => $servicioList
        ]);
        
    }

    
    /**
     * @Route("/personalService", name="personalService")
     */
    public function personalService(): Response
    {
        if($_SESSION["user"]->getRol() != "Admin") return $this->redirectToRoute('auth');

        $servicio = $this->getDoctrine()->getRepository(Servicios::class)->find(explode(' ',$_POST['servicio'])[0]);
        $personal = $this->getDoctrine()->getRepository(PersonalData::class)->find(explode(' ',$_POST['servicio'])[1]);
        $servicePersonal= [];


       
        foreach ($personal as $key => $personalData) {
            $servicePersonal[$key]["id"] = $personalData->getId();
            $servicePersonal[$key]["id"] = $personalData->getId();
        }

        return $this->render('admin/personalService.html.twig', [
            "servicio" => $servicePersonal
        ]);
        
    }

   
    /**
     * @Route("/citasAdmin", name="citasAdmin")
     */
    public function citasAdmin(): Response
    {
        if($_SESSION["user"]->getRol() != "Admin") return $this->redirectToRoute('auth');
        
       
        $citas = $this->getDoctrine()->getRepository(Citas::class)->findAll();
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
        return $this->render('admin/citasAdmin.html.twig', [ "citas" => $citasList ]);

        }

       

 }

    
    
