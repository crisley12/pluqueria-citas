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
use App\Entity\Servicios;


class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(): Response
    {
        return $this->render('users/index.html.twig');

    }

    
    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        return $this->render('users/login.html.twig');
    }

   
    
   
/* el usuario está accediendo, se toma los campos requeridos de la base de datos con el findOneBy*/


    /**
     * @Route("/login-process", name="loginProcess", methods="POST")
     */
    public function loginProcess(): Response
    {
        $user = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy([
            "email" => $_POST['email'],
            "password" => $_POST['password'],
        ]);

 /*    Se obtiene los registros solicitados por el formulario de citas con el FindAll*/
        $servicios = $this->getDoctrine()->getRepository(Servicios::class)->findAll();
        $personales = [];
        $nombres = [];
        foreach ($servicios as $key => $servicio) {
            $personales[$servicio->getId()][] = $servicio->getPersonalData();
            $nombres[$key][] = $servicio->getServicio();
            $nombres[$key][] = $servicio->getCosto();
        }
            
  
        if($user && $user->getRol() == 'Admin') 
            return $this->render('dashboard/dashboard.html.twig');
        else if($user && $user->getRol() == 'Personal') 
            return $this->render('dashboard/dashboard.html.twig', [
                "servicios" => $nombres,
                "personales" => $personales
            ]);
        else if($user && $user->getRol() == 'Cliente') 
            return $this->render('citas/cita.html.twig', [
                "servicios" => $nombres,
                "personales" => $personales
            ]);
         else return $this->render('users/login error.html.twig');
    }




    

    
 
    /**
     * @Route("/signup", name="signup")
     */
    public function signup(): Response
    {
        return $this->render('users/signup.html.twig');
    }
   

    /**
     * @Route("/success", name="successSignup", methods="POST")
     */
    public function successSignup(): Response
    {
        
        if($_POST['password'] == $_POST['cpassword']){

        $user = new Usuario();
        $user->setName($_POST["username"]);
        $user->setEmail($_POST["email"]);
        $user->setPassword($_POST["password"]);
        $user->setTelefono($_POST["telefono"]);
        $user->setRol("Cliente");

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

            return $this->render('users/success.html.twig');
        } catch (\Throwable $th) {
            return $this->render('users/error.html.twig');
        }
        } else {        
           return $this->render('users/error.html.twig');
        }

    }
    
}

