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
        $nombres = [];
        foreach ($servicios as $key => $servicio) {
            $nombres[$key][] = $servicio->getId();
            $nombres[$key][] = $servicio->getServicio();
            $nombres[$key][] = $servicio->getCosto();

            foreach ($servicio->getPersonalData() as $idx => $personal) {
                $nombres[$key]['personal'][$idx][] = $personal->getId();
                $nombres[$key]['personal'][$idx][] = $personal->getUsuario();
            }
        }
        
        $_SESSION['user'] = $user;
        if($user && $user->getRol() == 'Admin') 
            return $this->redirectToRoute('adminDashboard');
        else if($user && $user->getRol() == 'Personal') 
            return $this->redirectToRoute('personalDashboard');
        else if($user && $user->getRol() == 'Cliente') 
            return $this->render('citas/cita.html.twig', [
                "servicios" => $nombres,
            ]);
        else return $this->render('users/loginerror.html.twig');
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

                return $this->render('users/success.html.twig');
            } catch (\Throwable $th) {
                return $this->render('users/error.html.twig', [ "error" => "Este correo ya esxiste, ingrese otro" ]);
            }
        } else {        
           return $this->render('users/error.html.twig', [ "error" => $error ]);
        }
    }
    
}

