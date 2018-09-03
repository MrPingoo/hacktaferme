<?php

// src/Controller/LoginController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    /**
    * @Route("/login", name="app_login")
    */
    public function login()
    {
        return $this->render('login.html.twig');
    }
}