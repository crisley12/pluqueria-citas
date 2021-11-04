<?php

namespace App\Controller;

if (!isset($_SESSION)){
    session_start();
}

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use App\Entity\ClienteData;
use App\Entity\PersonalData;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="adminDashboard")
     */
    public function index(): Response
    {
        if($_SESSION["user"]->getRol() != "Admin") return $this->redirectToRoute('auth');

        return $this->render('admin/dashboard.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/listausers", name="listausers")
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
     * @Route("/createusers", name="createUsers", methods="POST")
     */
    public function createUsers(): Response
    {
        $error = null;
        if($_POST['password'] != $_POST['cpassword']) $error = "Contraseña invalida, vuelve a intertarlo";
        else if(strlen($_POST['password']) < 4 || strlen($_POST['password']) > 8) $error = "Contraseña invalida, ingrese undigito mayor a 4 y menor a 8";
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

                return $this->redirectToRoute('listausers');
            } catch (\Throwable $th) {
                return $this->redirectToRoute('listausers');
                //              return $this->render('admin/createerror.html.twig', [ "error" => "Este correo ya esxiste, ingrese otro" ]);
            }
        } else {        
            return $this->redirectToRoute('listausers');
//           return $this->render('admin/createerror.html.twig', [ "error" => $error ]);
        }
    }
    
    /**
     * @Route("/updateusers", name="updateUsers", methods="POST")
     */
    public function updateUsers(): Response
    {
        $error = null;
        if($_POST['password'] != $_POST['cpassword']) $error = "Contraseña invalida, vuelve a intertarlo";
        else if(strlen($_POST['password']) < 4 || strlen($_POST['password']) > 8) $error = "Contraseña invalida, ingrese undigito mayor a 4 y menor a 8";
        else if($_POST['telefono'] < 4140000000) $error = "ingrese un número de telefono valido";
           
        if($error == null){
            $user = $this->getDoctrine()->getRepository(Usuario::class)->find($_POST["id"]);
            $user->setName($_POST["username"]);
            $user->setPassword($_POST["password"]);
            $user->setTelefono($_POST["telefono"]);

            try {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('listausers');
            } catch (\Throwable $th) {
                return $this->redirectToRoute('listausers');
                //              return $this->render('admin/createerror.html.twig', [ "error" => "Este correo ya esxiste, ingrese otro" ]);
            }
        } else {        
            return $this->redirectToRoute('listausers');
//           return $this->render('admin/createerror.html.twig', [ "error" => $error ]);
        }
    }

    /**
     * @Route("/personal", name="Personal")
     */
    public function personal(): Response
    {
        if($_SESSION["user"]->getRol() != "Admin") return $this->redirectToRoute('auth');

        return $this->render('admin/personal.html.twig');
    }
}
